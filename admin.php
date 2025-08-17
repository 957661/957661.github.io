<?php
require_once __DIR__ . "/functions.php";
ensure_session();

// 登录处理
if (isset($_POST['action']) && $_POST['action'] === 'login') {
    $u = $_POST['username'] ?? '';
    $p = $_POST['password'] ?? '';
    if ($u === ADMIN_USERNAME && $p === ADMIN_PASSWORD) {
        $_SESSION['logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "账号或密码错误";
    }
}

// 退出
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header("Location: admin.php");
    exit;
}

// 登录视图
if (!is_logged_in()) {
    $csrf = csrf_token();
    echo <<<HTML
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>域名后台登录</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
<div class="min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
    <h1 class="text-2xl font-bold mb-6 text-center">后台登录</h1>
    <form method="post">
      <input type="hidden" name="csrf_token" value="$csrf">
      <input type="hidden" name="action" value="login">
      <div class="mb-4">
        <label class="block text-sm mb-2">用户名</label>
        <input name="username" class="w-full border rounded p-3" placeholder="admin" required>
      </div>
      <div class="mb-6">
        <label class="block text-sm mb-2">密码</label>
        <input type="password" name="password" class="w-full border rounded p-3" placeholder="********" required>
      </div>
      <button class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">登录</button>
      <p class="text-xs text-gray-500 mt-4">默认账号 admin / 密码 admin123（首次登录后请修改 config.php）</p>
      %ERROR%
    </form>
  </div>
</div>
</body>
</html>
HTML;
    if (!empty($error)) {
        echo "<script>document.body.innerHTML = document.body.innerHTML.replace('%ERROR%', '<p class=\"text-red-500 text-sm mt-2 text-center\">" . htmlspecialchars($error) . "</p>');</script>";
    } else {
        echo "<script>document.body.innerHTML = document.body.innerHTML.replace('%ERROR%', '');</script>";
    }
    exit;
}

// 以下为已登录后的后台管理
check_csrf();

$domains = load_json("domains");
$sold = load_json("sold");
$error = '';
$successMessage = '';
$keepValues = [];

// 处理新增/编辑/删除
$op = $_POST['op'] ?? '';
if ($op === 'create' || $op === 'update') {
    $inputId = intval($_POST['id'] ?? 0);
    $existingIds = array_column($domains, 'id');
    
    // 唯一性校验
    if ($op === 'create' && $inputId > 0) {
        if (in_array($inputId, $existingIds)) {
            $error = "ID已存在，请更换";
        }
    }
    if ($op === 'update') {
        $originalId = intval($_POST['original_id'] ?? 0);
        // 排除自身ID的其他重复检查
        $otherIds = array_filter($existingIds, fn($id) => $id != $originalId);
        if (in_array($inputId, $otherIds)) {
            $error = "ID已存在，请更换";
        }
    }

    if (empty($error)) {
        // 生成ID（如果未输入则自动生成）
        $autoId = $inputId > 0 ? $inputId : (count($domains) ? max($existingIds) + 1 : 1);
        
        $item = [
            "id" => $autoId,
            "name" => trim($_POST['name'] ?? ""),
            "price" => intval($_POST['price'] ?? 0),
            "suffix" => trim($_POST['suffix'] ?? ""),
            "category" => trim($_POST['category'] ?? ""),
            "description" => trim($_POST['description'] ?? ""),
            "length" => intval($_POST['length'] ?? 0),
            "added" => trim($_POST['added'] ?? date("Y-m-d"))
        ];

        if ($op === 'create') {
            $domains[] = $item;
        } else {
            foreach ($domains as &$d) {
                if ($d['id'] == $originalId) { 
                    $d = $item; 
                    break; 
                }
            }
        }
        save_json("domains", $domains);
        
        // 判断是保存还是继续添加
        $saveAction = $_POST['save_action'] ?? 'save';
        if ($saveAction === 'continue' && $op === 'create') {
            // 继续添加 - 不跳转，保留表单数据（除了ID）
            $keepValues = $item;
            $keepValues['id'] = ''; // 清空ID，让系统自动生成
            $successMessage = "已保存，可继续添加";
        } else {
            // 正常保存 - 跳转
            header("Location: admin.php?saved=1");
            exit;
        }
    } else {
        // 有错误时保留表单数据
        $keepValues = [
            "id" => $inputId,
            "name" => trim($_POST['name'] ?? ""),
            "price" => intval($_POST['price'] ?? 0),
            "suffix" => trim($_POST['suffix'] ?? ""),
            "category" => trim($_POST['category'] ?? ""),
            "description" => trim($_POST['description'] ?? ""),
            "length" => intval($_POST['length'] ?? 0),
            "added" => trim($_POST['added'] ?? date("Y-m-d"))
        ];
    }
}
if ($op === 'delete') {
    $id = intval($_POST['id'] ?? 0);
    $domains = array_values(array_filter($domains, fn($d) => $d['id'] != $id));
    save_json("domains", $domains);
    header("Location: admin.php?deleted=1");
    exit;
}
// Sold 添加/删除
if ($op === 'sold_add') {
    $name = trim($_POST['sold_name'] ?? '');
    $time = trim($_POST['sold_time'] ?? '刚刚');
    if ($name) {
        $sold[] = ["name"=>$name, "time"=>$time];
        save_json("sold", $sold);
    }
    header("Location: admin.php?saved=1#sold");
    exit;
}
if ($op === 'sold_delete') {
    $index = intval($_POST['index'] ?? -1);
    if (isset($sold[$index])) {
        array_splice($sold, $index, 1);
        save_json("sold", $sold);
    }
    header("Location: admin.php?saved=1#sold");
    exit;
}

$csrf = csrf_token();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>域名管理后台</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-50">
<header class="bg-white border-b">
  <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
    <h1 class="text-xl font-bold">域名管理后台</h1>
    <div>
      <a class="text-blue-600 mr-4" href="./" target="_blank">打开前台</a>
      <a class="text-red-600" href="admin.php?logout=1">退出</a>
    </div>
  </div>
</header>

<main class="max-w-6xl mx-auto px-4 py-6">
  <?php if (!empty($successMessage)): ?>
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded"><?php echo htmlspecialchars($successMessage); ?></div>
  <?php endif; ?>
  <?php if (!empty($_GET['saved'])): ?>
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">已保存</div>
  <?php endif; ?>
  <?php if (!empty($_GET['deleted'])): ?>
    <div class="mb-4 p-3 bg-yellow-100 text-yellow-700 rounded">已删除</div>
  <?php endif; ?>
  <?php if (!empty($error)): ?>
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <section class="lg:col-span-2 bg-white rounded-xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">域名列表</h2>
      <div class="overflow-auto">
        <table class="min-w-full text-sm">
          <thead><tr class="border-b">
            <th class="p-2 text-left">ID</th>
            <th class="p-2 text-left">域名</th>
            <th class="p-2 text-left">价格</th>
            <th class="p-2 text-left">后缀</th>
            <th class="p-2 text-left">分类</th>
            <th class="p-2 text-left">长度</th>
            <th class="p-2 text-left">添加日期</th>
            <th class="p-2 text-left">操作</th>
          </tr></thead>
          <tbody>
          <?php foreach ($domains as $d): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-2"><?php echo intval($d['id']); ?></td>
              <td class="p-2"><?php echo htmlspecialchars($d['name']); ?></td>
              <td class="p-2">¥<?php echo intval($d['price']); ?></td>
              <td class="p-2"><?php echo htmlspecialchars($d['suffix']); ?></td>
              <td class="p-2"><?php echo htmlspecialchars($d['category']); ?></td>
              <td class="p-2"><?php echo intval($d['length']); ?></td>
              <td class="p-2"><?php echo htmlspecialchars($d['added']); ?></td>
              <td class="p-2">
                <button onclick="fillForm(<?php echo htmlspecialchars(json_encode($d, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)); ?>)" class="px-2 py-1 bg-blue-600 text-white rounded">编辑</button>
                <form method="post" class="inline" onsubmit="return confirm('确定删除？')">
                  <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">
                  <input type="hidden" name="op" value="delete">
                  <input type="hidden" name="id" value="<?php echo intval($d['id']); ?>">
                  <button class="px-2 py-1 bg-red-600 text-white rounded">删除</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>

    <section class="bg-white rounded-xl shadow p-5">
      <h2 class="text-lg font-semibold mb-4">新增/编辑域名</h2>
      <form method="post" class="space-y-3">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">
        <input type="hidden" name="op" value="create" id="op">
        <input type="hidden" name="original_id" id="original_id">
        
        <div>
          <label class="block text-sm mb-1">域名ID（留空自动生成）</label>
          <input type="number" name="id" id="id" class="w-full border rounded p-2" placeholder="留空则自动按顺序生成" value="<?php echo htmlspecialchars($keepValues['id'] ?? ''); ?>">
        </div>
        
        <div>
          <label class="block text-sm mb-1">域名（如：66666.cm）</label>
          <input name="name" id="name" class="w-full border rounded p-2" required value="<?php echo htmlspecialchars($keepValues['name'] ?? ''); ?>">
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-sm mb-1">价格（￥）</label>
            <input type="number" name="price" id="price" class="w-full border rounded p-2" required value="<?php echo htmlspecialchars($keepValues['price'] ?? ''); ?>">
          </div>
          <div>
            <label class="block text-sm mb-1">后缀</label>
            <input name="suffix" id="suffix" class="w-full border rounded p-2" placeholder=".cm" required value="<?php echo htmlspecialchars($keepValues['suffix'] ?? ''); ?>">
          </div>
        </div>
        <div class="grid grid-cols-2 gap-3">
          <div>
            <label class="block text-sm mb-1">分类</label>
            <input name="category" id="category" class="w-full border rounded p-2" placeholder="豹子号/顺子号/词组号" value="<?php echo htmlspecialchars($keepValues['category'] ?? ''); ?>">
          </div>
          <div>
            <label class="block text-sm mb-1">长度</label>
            <input type="number" name="length" id="length" class="w-full border rounded p-2" placeholder="5" value="<?php echo htmlspecialchars($keepValues['length'] ?? ''); ?>">
          </div>
        </div>
        <div>
          <label class="block text-sm mb-1">描述</label>
          <textarea name="description" id="description" class="w-full border rounded p-2" rows="3"><?php echo htmlspecialchars($keepValues['description'] ?? ''); ?></textarea>
        </div>
        <div>
          <label class="block text-sm mb-1">添加日期</label>
          <input name="added" id="added" class="w-full border rounded p-2" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($keepValues['added'] ?? date('Y-m-d')); ?>">
        </div>
        <div class="flex gap-3">
          <button type="submit" name="save_action" value="save" class="px-4 py-2 bg-green-600 text-white rounded">保存</button>
          <button type="submit" name="save_action" value="continue" class="px-4 py-2 bg-blue-600 text-white rounded">继续添加</button>
          <button type="button" onclick="resetForm()" class="px-4 py-2 border rounded">重置</button>
        </div>
      </form>
      <script>
        function fillForm(d){
          document.getElementById('op').value = 'update';
          document.getElementById('original_id').value = d.id;
          document.getElementById('id').value = d.id;
          document.getElementById('name').value = d.name;
          document.getElementById('price').value = d.price;
          document.getElementById('suffix').value = d.suffix;
          document.getElementById('category').value = d.category;
          document.getElementById('length').value = d.length;
          document.getElementById('description').value = d.description;
          document.getElementById('added').value = d.added;
        }
        function resetForm(){
          document.getElementById('op').value = 'create';
          document.getElementById('original_id').value = '';
          document.getElementById('id').value = '';
          document.getElementById('name').value = '';
          document.getElementById('price').value = '';
          document.getElementById('suffix').value = '';
          document.getElementById('category').value = '';
          document.getElementById('length').value = '';
          document.getElementById('description').value = '';
          document.getElementById('added').value = '<?php echo date('Y-m-d'); ?>';
        }
      </script>
    </section>
  </div>

  <section id="sold" class="mt-6 bg-white rounded-xl shadow p-5">
    <h2 class="text-lg font-semibold mb-4">已出售滚动条</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 overflow-auto">
        <table class="min-w-full text-sm">
          <thead><tr class="border-b">
            <th class="p-2 text-left">#</th><th class="p-2 text-left">域名</th><th class="p-2 text-left">时间</th><th class="p-2">操作</th>
          </tr></thead>
          <tbody>
          <?php foreach ($sold as $i=>$s): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-2"><?php echo $i; ?></td>
              <td class="p-2"><?php echo htmlspecialchars($s['name'] ?? ''); ?></td>
              <td class="p-2"><?php echo htmlspecialchars($s['time'] ?? ''); ?></td>
              <td class="p-2">
                <form method="post" class="inline" onsubmit="return confirm('确定删除这条已出售记录？')">
                  <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">
                  <input type="hidden" name="op" value="sold_delete">
                  <input type="hidden" name="index" value="<?php echo $i; ?>">
                  <button class="px-2 py-1 bg-red-600 text-white rounded">删除</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div>
        <h3 class="font-semibold mb-2">新增已出售记录</h3>
        <form method="post" class="space-y-3">
          <input type="hidden" name="csrf_token" value="<?php echo $csrf; ?>">
          <input type="hidden" name="op" value="sold_add">
          <div>
            <label class="block text-sm mb-1">域名</label>
            <input name="sold_name" class="w-full border rounded p-2" placeholder="e.g. 123456.cm" required>
          </div>
          <div>
            <label class="block text-sm mb-1">时间说明</label>
            <input name="sold_time" class="w-full border rounded p-2" placeholder="如：刚刚 / 10分钟前" required>
          </div>
          <button class="px-4 py-2 bg-blue-600 text-white rounded">添加</button>
        </form>
      </div>
    </div>
  </section>
</main>
</body>
</html>