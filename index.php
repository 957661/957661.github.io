<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>域名选号网 - 找到您的完美域名</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">
    
    <!-- Tailwind 配置 -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#165DFF',
                        secondary: '#36CFC9',
                        accent: '#722ED1',
                        neutral: '#F2F3F5',
                        'neutral-dark': '#4E5969',
                        success: '#00B42A',
                        warning: '#FF7D00',
                        danger: '#F53F3F'
                    },
                    fontFamily: {
                        inter: ['Inter', 'system-ui', 'sans-serif'],
                    },
                    boxShadow: {
                        'card': '0 4px 20px rgba(0, 0, 0, 0.08)',
                        'card-hover': '0 8px 30px rgba(0, 0, 0, 0.12)',
                        'modal': '0 10px 30px rgba(0, 0, 0, 0.15)',
                        'filter': '0 2px 10px rgba(0, 0, 0, 0.05)',
                    }
                },
            }
        }
    </script>
    
    <style type="text/tailwindcss">
        @layer utilities {
            .content-auto {
                content-visibility: auto;
            }
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .transition-all-300 {
                transition: all 300ms ease-in-out;
            }
            .backdrop-blur {
                backdrop-filter: blur(4px);
            }
            .marquee-container {
                overflow: hidden;
                position: relative;
            }
            .marquee-content {
                display: flex;
                animation: marquee 25s linear infinite;
            }
            .marquee-item {
                margin-right: 2rem;
                white-space: nowrap;
            }
            @keyframes marquee {
                0% { transform: translateX(0); }
                100% { transform: translateX(-50%); }
            }
            .marquee-container:hover .marquee-content {
                animation-play-state: paused;
            }
            /* 自定义复选框和单选按钮样式 */
            .custom-checkbox, .custom-radio {
                appearance: none;
                -webkit-appearance: none;
                width: 18px;
                height: 18px;
                border-radius: 4px;
                border: 2px solid #d1d5db;
                background-color: white;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                outline: none;
                transition: all 0.2s ease;
            }
            .custom-radio {
                border-radius: 50%;
            }
            .custom-checkbox:checked, .custom-radio:checked {
                border-color: #165DFF;
                background-color: #165DFF;
            }
            .custom-checkbox:checked::after {
                content: "✓";
                color: white;
                font-size: 14px;
                font-weight: bold;
            }
            .custom-radio:checked::after {
                content: "";
                width: 8px;
                height: 8px;
                border-radius: 50%;
                background-color: white;
            }
            .filter-section {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            .filter-section:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.07);
            }
        }
    </style>
</head>
<body class="font-inter bg-gray-50 text-gray-800 min-h-screen flex flex-col">
    <!-- 导航栏 -->
    <header class="bg-white shadow-sm sticky top-0 z-50 transition-all duration-300" id="navbar">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fa fa-globe text-primary text-2xl"></i>
                <h1 class="text-xl md:text-2xl font-bold text-primary">帝王哥域名选号网</h1>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-primary font-medium">首页</a>
                <a href="#domains" class="text-gray-600 hover:text-primary transition-colors">域名列表</a>
                <a href="#" class="text-gray-600 hover:text-primary transition-colors">帮助中心</a>
            </nav>
            
            <div class="flex items-center">
                <button class="md:hidden text-gray-600" id="mobile-menu-button">
                    <i class="fa fa-bars text-xl"></i>
                </button>
            </div>
        </div>
        
        <!-- 移动端菜单 -->
        <div class="md:hidden hidden bg-white border-t" id="mobile-menu">
            <div class="container mx-auto px-4 py-3 flex flex-col space-y-3">
                <a href="#" class="text-primary font-medium py-2">首页</a>
                <a href="#domains" class="text-gray-600 hover:text-primary transition-colors py-2">域名列表</a>
                <a href="#" class="text-gray-600 hover:text-primary transition-colors py-2">帮助中心</a>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <!-- 英雄区域 -->
        <section class="bg-gradient-to-r from-primary/90 to-primary py-16 md:py-24">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-[clamp(2rem,5vw,3.5rem)] font-bold text-white mb-4 text-shadow">
                    找到完美的域名，开启您的在线之旅
                </h2>
                <p class="text-[clamp(1rem,2vw,1.25rem)] text-white/90 max-w-2xl mx-auto mb-8">
                    浏览数千个优质域名，通过智能筛选快速找到符合您需求的理想选择
                </p>
                
                <!-- 主搜索框 -->
                <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-1 flex flex-col md:flex-row">
                    <div class="flex-grow relative">
                        <i class="fa fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            type="text" 
                            id="main-search"
                            placeholder="输入关键词搜索域名..." 
                            class="w-full pl-10 pr-4 py-3 rounded-md focus:outline-none focus:ring-2 focus:ring-primary/50"
                        >
                    </div>
                    <button id="main-search-btn" class="mt-1 md:mt-0 md:ml-1 px-6 py-3 bg-primary text-white rounded-md hover:bg-primary/90 transition-colors font-medium">
                        搜索域名
                    </button>
                </div>
                
                <!-- 热门标签 -->
                <div class="mt-8 flex flex-wrap justify-center gap-2">
                    <span class="text-white/80">热门搜索:</span>
                    <a href="#" class="text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-sm transition-colors">豹子号</a>
                    <a href="#" class="text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-sm transition-colors">顺子号</a>
                    <a href="#" class="text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-sm transition-colors">爱情号</a>
                    <a href="#" class="text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-sm transition-colors">发财号</a>
                    <a href="#" class="text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-sm transition-colors">词组号</a>
                    <a href="#" class="text-white bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full text-sm transition-colors">姓氏号</a>
                </div>
            </div>
        </section>

        <!-- 域名列表区域 -->
        <section id="domains" class="py-12 md:py-16">
            <div class="container mx-auto px-4">
                <!-- 已出售域名滚动横幅 -->
                <div class="bg-danger/10 border border-danger/20 rounded-lg mb-8 overflow-hidden">
                    <div class="marquee-container py-3">
                        <div class="marquee-content" id="marquee-content">
                            <!-- 滚动内容会通过JS动态生成 -->
                        </div>
                    </div>
                </div>
                
                <!-- 域名列表 -->
                <div class="w-full">
                    <!-- 排序和结果统计 -->
                    <div class="bg-white rounded-xl shadow-card p-4 md:p-6 mb-6 flex flex-col md:flex-row justify-between items-start md:items-center">
                        <div>
                            <h3 class="text-xl font-bold mb-1">域名列表</h3>
                            <p class="text-gray-500 text-sm" id="domain-count">共找到 <span class="font-medium text-primary">15</span> 个域名</p>
                        </div>
                        
                        <div class="mt-4 md:mt-0 flex items-center space-x-3">
                            <span class="text-gray-600">排序方式:</span>
                            <select id="sort-select" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary/50 bg-white">
                                <option value="recommended">推荐排序</option>
                                <option value="price-asc">价格从低到高</option>
                                <option value="price-desc">价格从高到低</option>
                                <option value="length-asc">长度从短到长</option>
                                <option value="length-desc">长度从长到短</option>
                                <option value="newest">最新添加</option>
                            </select>
                            
                            <div class="hidden md:flex items-center space-x-2 border border-gray-300 rounded-lg p-1">
                                <button class="view-btn active px-3 py-1 rounded bg-primary text-white" data-view="grid">
                                    <i class="fa fa-th-large"></i>
                                </button>
                                <button class="view-btn px-3 py-1 rounded text-gray-600 hover:bg-gray-100" data-view="list">
                                    <i class="fa fa-list"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- 域名网格视图 -->
                    <div id="domain-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- 域名卡片会通过JS动态生成 -->
                    </div>
                    
                    <!-- 加载更多按钮 -->
                    <div class="mt-10 text-center">
                        <button id="load-more" class="px-8 py-3 border border-primary text-primary rounded-lg hover:bg-primary/5 transition-colors font-medium">
                            加载更多 <i class="fa fa-angle-down ml-1"></i>
                        </button>
                    </div>
                </div>
                
                <!-- 筛选条件区域 -->
                <div class="mt-12">
                    <div class="bg-white rounded-xl shadow-card overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100">
                            <h3 class="text-lg font-bold flex items-center">
                                <i class="fa fa-filter text-primary mr-2"></i> 筛选条件
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- 价格范围 -->
                                <div class="filter-section bg-gray-50 rounded-xl p-5 shadow-filter">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa fa-rmb text-primary"></i>
                                        </div>
                                        <h4 class="font-medium text-gray-800">价格范围</h4>
                                    </div>
                                    <div class="space-y-3 pl-1">
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="price" value="all" checked class="custom-radio">
                                            <span class="ml-3 text-gray-700">全部价格</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="price" value="0-100" class="custom-radio">
                                            <span class="ml-3 text-gray-700">¥0 - ¥100</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="price" value="100-500" class="custom-radio">
                                            <span class="ml-3 text-gray-700">¥100 - ¥500</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="price" value="500-1000" class="custom-radio">
                                            <span class="ml-3 text-gray-700">¥500 - ¥1000</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="price" value="1000+" class="custom-radio">
                                            <span class="ml-3 text-gray-700">¥1000以上</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- 域名后缀 -->
                                <div class="filter-section bg-gray-50 rounded-xl p-5 shadow-filter">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa fa-link text-primary"></i>
                                        </div>
                                        <h4 class="font-medium text-gray-800">域名后缀</h4>
                                    </div>
                                    <div class="flex flex-wrap gap-3 pl-1">
                                        <label class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 text-sm cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                            <input type="checkbox" value=".cm" checked class="custom-checkbox">
                                            <span class="ml-3 text-gray-700">.cm</span>
                                        </label>
                                        <label class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 text-sm cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                            <input type="checkbox" value=".ee" checked class="custom-checkbox">
                                            <span class="ml-3 text-gray-700">.ee</span>
                                        </label>
                                        <label class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 text-sm cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                            <input type="checkbox" value=".cn" checked class="custom-checkbox">
                                            <span class="ml-3 text-gray-700">.cn</span>
                                        </label>
                                        <label class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 text-sm cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                            <input type="checkbox" value=".ge" class="custom-checkbox">
                                            <span class="ml-3 text-gray-700">.ge</span>
                                        </label>
                                        <label class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 text-sm cursor-pointer hover:border-primary/50 hover:bg-primary/5 transition-all">
                                            <input type="checkbox" value=".cc" class="custom-checkbox">
                                            <span class="ml-3 text-gray-700">.cc</span>
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- 域名长度 -->
                                <div class="filter-section bg-gray-50 rounded-xl p-5 shadow-filter">
                                    <div class="flex items-center mb-4">
                                        <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                            <i class="fa fa-font text-primary"></i>
                                        </div>
                                        <h4 class="font-medium text-gray-800">域名长度</h4>
                                    </div>
                                    <div class="space-y-3 pl-1">
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="length" value="all" checked class="custom-radio">
                                            <span class="ml-3 text-gray-700">全部长度</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="length" value="short" class="custom-radio">
                                            <span class="ml-3 text-gray-700">短 (1-5字符)</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="length" value="medium" class="custom-radio">
                                            <span class="ml-3 text-gray-700">中 (6-10字符)</span>
                                        </label>
                                        <label class="flex items-center cursor-pointer hover:bg-gray-100 p-2 rounded-md transition-colors">
                                            <input type="radio" name="length" value="long" class="custom-radio">
                                            <span class="ml-3 text-gray-700">长 (11字符以上)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- 筛选按钮 -->
                            <div class="mt-8 flex flex-wrap gap-4">
                                <button id="filter-btn" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-all transform hover:-translate-y-0.5 shadow-md hover:shadow-lg font-medium flex items-center">
                                    <i class="fa fa-check mr-2"></i> 应用筛选
                                </button>
                                
                                <button id="reset-filter-btn" class="px-6 py-3 border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition-all transform hover:-translate-y-0.5 font-medium flex items-center">
                                    <i class="fa fa-refresh mr-2"></i> 重置筛选
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- 服务优势 -->
        <section class="py-12 md:py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-[clamp(1.5rem,3vw,2.5rem)] font-bold mb-4">为什么选择我们</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">我们提供最优质的域名选号服务，帮助您快速找到理想的域名，开启您的在线业务</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-card p-6 hover:shadow-card-hover transition-all duration-300 transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fa fa-search text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">智能搜索</h3>
                        <p class="text-gray-600">强大的搜索和筛选功能，帮助您快速找到符合需求的完美域名</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 hover:shadow-card-hover transition-all duration-300 transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fa fa-shield text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">安全可靠</h3>
                        <p class="text-gray-600">所有域名均经过严格审核，确保合法性和可用性，交易安全有保障</p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-card p-6 hover:shadow-card-hover transition-all duration-300 transform hover:-translate-y-1">
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <i class="fa fa-bolt text-primary text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">快速过户</h3>
                        <p class="text-gray-600">简化的过户流程，专业的技术支持，让您轻松拥有心仪的域名</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- 页脚 -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fa fa-globe text-primary text-2xl"></i>
                        <h3 class="text-xl font-bold">帝王哥域名靓号网</h3>
                    </div>
                    <p class="text-gray-400 mb-4">您的专业域名选择平台，提供优质域名资源和便捷的选号服务</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fa fa-weibo text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fa fa-wechat text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                            <i class="fa fa-qq text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">快速链接</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">首页</a></li>
                        <li><a href="#domains" class="text-gray-400 hover:text-white transition-colors">域名列表</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">热门域名</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">最新域名</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">帮助中心</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">购买流程</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">域名过户</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">常见问题</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">联系我们</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-medium mb-4">联系我们</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <i class="fa fa-map-marker text-primary mt-1 mr-3"></i>
                            <span class="text-gray-400">哈尔滨市帝王哥工作室</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa fa-phone text-primary mr-3"></i>
                            <span class="text-gray-400">400-888-8888</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa fa-envelope text-primary mr-3"></i>
                            <span class="text-gray-400">5555555@163.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
                <p>© 2025 帝王哥靓号网 版权所有 | 客服微信478478</p>
            </div>
        </div>
    </footer>

    <!-- 购买提示模态框 -->
    <div id="purchase-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur"></div>
        <div class="relative bg-white rounded-xl shadow-modal w-full max-w-md p-6 transform transition-all">
            <button id="close-modal" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                <i class="fa fa-times text-xl"></i>
            </button>
            
            <div class="text-center py-4">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa fa-wechat text-primary text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-2">购买咨询</h3>
                <p class="text-gray-600 mb-4">如需购买该域名，请添加微信联系我们</p>
                <div class="bg-neutral rounded-lg p-3 inline-block mb-6">
                    <span class="font-bold text-gray-800">微信号478478</span>
                </div>
                <button id="confirm-modal" class="px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-medium">
                    我知道了
                </button>
            </div>
        </div>
    </div>

    <!-- 成功提示弹窗 -->
    <div id="success-toast" class="fixed top-20 right-5 bg-success text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 flex items-center z-50">
        <i class="fa fa-check-circle mr-2"></i>
        <span id="toast-message">操作成功！</span>
    </div>

    <?php
    // 载入数据文件（JSON）
    $domains_path = __DIR__ . "/data/domains.json";
    $sold_path = __DIR__ . "/data/sold.json";
    if (!file_exists($domains_path)) { file_put_contents($domains_path, "[]"); }
    if (!file_exists($sold_path)) { file_put_contents($sold_path, "[]"); }
    $domains = json_decode(file_get_contents($domains_path), true);
    if (!$domains) { $domains = []; }
    $sold = json_decode(file_get_contents($sold_path), true);
    if (!$sold) { $sold = []; }
?>
<script>
    // 由PHP注入的数据
    const soldDomains = <?php echo json_encode($sold, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); ?>;
    const allDomains = <?php echo json_encode($domains, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES); ?>;
</script>
<script>
        // 已出售的域名 - 用于滚动横幅展示
        /* soldDomains moved to PHP-injected script */

        // 所有域名数据 - 共15个，用于演示默认显示9个，然后分2次加载3个
        /* allDomains moved to PHP-injected script */

        // 显示配置
        const initialDisplayCount = 12; // 默认显示12个
        const loadMoreCount = 6; // 每次加载更多显示6个
        let displayedCount = initialDisplayCount; // 当前显示的数量
        
        // 当前显示的域名
        let currentDomains = [...allDomains];

        // DOM元素
        const domainGrid = document.getElementById('domain-grid');
        const domainCount = document.querySelector('#domain-count span');
        const mainSearch = document.getElementById('main-search');
        const mainSearchBtn = document.getElementById('main-search-btn');
        const filterBtn = document.getElementById('filter-btn');
        const resetFilterBtn = document.getElementById('reset-filter-btn');
        const sortSelect = document.getElementById('sort-select');
        const viewBtns = document.querySelectorAll('.view-btn');
        const successToast = document.getElementById('success-toast');
        const toastMessage = document.getElementById('toast-message');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const navbar = document.getElementById('navbar');
        const loadMoreBtn = document.getElementById('load-more');
        const purchaseModal = document.getElementById('purchase-modal');
        const closeModal = document.getElementById('close-modal');
        const confirmModal = document.getElementById('confirm-modal');
        const marqueeContent = document.getElementById('marquee-content');

        // 初始化页面
        document.addEventListener('DOMContentLoaded', () => {
            // 初始化滚动横幅
            initMarquee();
            
            // 初始显示前9个域名
            renderDomains(getDisplayedDomains());
            updateDomainCount(allDomains.length);
            
            // 检查是否需要禁用加载更多按钮
            checkLoadMoreButton();
            
            // 事件监听
            mainSearchBtn.addEventListener('click', handleSearch);
            mainSearch.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') handleSearch();
            });
            
            filterBtn.addEventListener('click', applyFilters);
            resetFilterBtn.addEventListener('click', resetFilters);
            sortSelect.addEventListener('change', sortDomains);
            viewBtns.forEach(btn => btn.addEventListener('click', changeView));
            mobileMenuButton.addEventListener('click', toggleMobileMenu);
            loadMoreBtn.addEventListener('click', loadMoreDomains);
            
            // 模态框事件
            closeModal.addEventListener('click', closePurchaseModal);
            confirmModal.addEventListener('click', closePurchaseModal);
            
            // 点击模态框外部关闭
            purchaseModal.addEventListener('click', (e) => {
                if (e.target === purchaseModal) {
                    closePurchaseModal();
                }
            });
            
            // 滚动监听，改变导航栏样式
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('py-2', 'shadow');
                    navbar.classList.remove('py-3', 'shadow-sm');
                } else {
                    navbar.classList.add('py-3', 'shadow-sm');
                    navbar.classList.remove('py-2', 'shadow');
                }
            });
        });

        // 初始化滚动横幅
        function initMarquee() {
            // 为了实现无缝滚动，我们复制一份内容
            const content = [...soldDomains, ...soldDomains];
            
            content.forEach(domain => {
                const item = document.createElement('div');
                item.className = 'marquee-item flex items-center';
                item.innerHTML = `
                    <i class="fa fa-bell text-danger mr-2"></i>
                    <span class="text-danger font-medium">${domain.name}</span>
                    <span class="text-gray-700 ml-1">已出售</span>
                    <span class="text-gray-500 text-sm ml-2">(${domain.time})</span>
                `;
                marqueeContent.appendChild(item);
            });
        }

        // 获取当前应显示的域名
        function getDisplayedDomains() {
            return currentDomains.slice(0, displayedCount);
        }

        // 渲染域名列表
        function renderDomains(domainsToRender) {
            domainGrid.innerHTML = '';
            
            if (domainsToRender.length === 0) {
                domainGrid.innerHTML = `
                    <div class="col-span-full py-16 text-center">
                        <i class="fa fa-search text-gray-300 text-5xl mb-4"></i>
                        <h3 class="text-xl font-medium text-gray-500">未找到符合条件的域名</h3>
                        <p class="text-gray-400 mt-2">请尝试调整搜索条件或关键词</p>
                    </div>
                `;
                return;
            }
            
            domainsToRender.forEach(domain => {
                const domainCard = document.createElement('div');
                domainCard.className = 'domain-card bg-white rounded-xl shadow-card overflow-hidden hover:shadow-card-hover transition-all duration-300 transform hover:-translate-y-1';
                domainCard.innerHTML = `
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="inline-block px-2 py-1 bg-primary/10 text-primary text-xs rounded-md mb-2">${domain.category}</span>
                                <h3 class="text-xl font-bold text-gray-800">${domain.name}</h3>
                            </div>
                            <span class="text-lg font-bold text-primary">¥${domain.price}</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-5 line-clamp-2">${domain.description || '无描述信息'}</p>
                        
                        <div class="flex flex-wrap gap-2 mb-5">
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">${domain.suffix}</span>
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">${domain.length}字符</span>
                            <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">添加于 ${domain.added}</span>
                        </div>
                        
                        <div>
                            <button class="w-full py-3 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors font-medium purchase-btn" data-domain="${domain.name}">
                                <i class="fa fa-shopping-cart mr-2"></i> 购买域名
                            </button>
                        </div>
                    </div>
                `;
                domainGrid.appendChild(domainCard);
            });
            
            // 为所有购买按钮添加点击事件
            document.querySelectorAll('.purchase-btn').forEach(btn => {
                btn.addEventListener('click', openPurchaseModal);
            });
        }

        // 更新域名计数
        function updateDomainCount(count) {
            domainCount.textContent = count;
        }

        // 处理搜索
        function handleSearch() {
            const searchTerm = mainSearch.value.toLowerCase().trim();
            
            // 重置显示计数
            displayedCount = initialDisplayCount;
            
            if (!searchTerm) {
                currentDomains = [...allDomains];
            } else {
                currentDomains = allDomains.filter(domain => 
                    domain.name.toLowerCase().includes(searchTerm) || 
                    domain.description.toLowerCase().includes(searchTerm) ||
                    domain.category.toLowerCase().includes(searchTerm)
                );
            }
            
            renderDomains(getDisplayedDomains());
            updateDomainCount(currentDomains.length);
            checkLoadMoreButton();
        }

        // 应用筛选
        function applyFilters() {
            // 重置显示计数
            displayedCount = initialDisplayCount;
            
            // 获取价格筛选值
            const priceValue = document.querySelector('input[name="price"]:checked').value;
            
            // 获取选中的域名后缀
            const suffixValues = Array.from(document.querySelectorAll('input[type="checkbox"]:checked')).map(el => el.value);
            
            // 获取长度筛选值
            const lengthValue = document.querySelector('input[name="length"]:checked').value;
            
            // 应用筛选
            currentDomains = [...allDomains];
            
            // 价格筛选
            if (priceValue !== 'all') {
                const [min, max] = priceValue.split('-');
                currentDomains = currentDomains.filter(domain => {
                    if (max) {
                        return domain.price >= parseInt(min) && domain.price <= parseInt(max);
                    } else {
                        return domain.price >= parseInt(min);
                    }
                });
            }
            
            // 后缀筛选
            currentDomains = currentDomains.filter(domain => suffixValues.includes(domain.suffix));
            
            // 长度筛选
            if (lengthValue !== 'all') {
                switch(lengthValue) {
                    case 'short':
                        currentDomains = currentDomains.filter(domain => domain.length <= 5);
                        break;
                    case 'medium':
                        currentDomains = currentDomains.filter(domain => domain.length >= 6 && domain.length <= 10);
                        break;
                    case 'long':
                        currentDomains = currentDomains.filter(domain => domain.length >= 11);
                        break;
                }
            }
            
            // 应用搜索词筛选
            const searchTerm = mainSearch.value.toLowerCase().trim();
            if (searchTerm) {
                currentDomains = currentDomains.filter(domain => 
                    domain.name.toLowerCase().includes(searchTerm) || 
                    domain.description.toLowerCase().includes(searchTerm) ||
                    domain.category.toLowerCase().includes(searchTerm)
                );
            }
            
            renderDomains(getDisplayedDomains());
            updateDomainCount(currentDomains.length);
            checkLoadMoreButton();
            
            // 显示提示
            showToast(`已筛选出 ${currentDomains.length} 个域名`);
        }

        // 重置筛选
        function resetFilters() {
            // 重置显示计数
            displayedCount = initialDisplayCount;
            
            // 重置价格筛选
            document.querySelector('input[name="price"][value="all"]').checked = true;
            
            // 重置后缀筛选（默认选中.com, .cn, .net）
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.checked = ['.com', '.cn', '.net'].includes(checkbox.value);
            });
            
            // 重置长度筛选
            document.querySelector('input[name="length"][value="all"]').checked = true;
            
            // 清空搜索框
            mainSearch.value = '';
            
            // 恢复所有域名
            currentDomains = [...allDomains];
            
            // 重新渲染
            renderDomains(getDisplayedDomains());
            updateDomainCount(currentDomains.length);
            checkLoadMoreButton();
            
            // 显示提示
            showToast('筛选条件已重置');
        }

        // 排序域名
        function sortDomains() {
            const sortValue = sortSelect.value;
            
            switch(sortValue) {
                case 'price-asc':
                    currentDomains.sort((a, b) => a.price - b.price);
                    break;
                case 'price-desc':
                    currentDomains.sort((a, b) => b.price - a.price);
                    break;
                case 'length-asc':
                    currentDomains.sort((a, b) => a.length - b.length);
                    break;
                case 'length-desc':
                    currentDomains.sort((a, b) => b.length - a.length);
                    break;
                case 'newest':
                    currentDomains.sort((a, b) => new Date(b.added) - new Date(a.added));
                    break;
                case 'recommended':
                default:
                    // 推荐排序
                    currentDomains.sort((a, b) => {
                        if (a.suffix === '.com' && b.suffix !== '.com') return -1;
                        if (a.suffix !== '.com' && b.suffix === '.com') return 1;
                        return a.length - b.length;
                    });
            }
            
            // 重新渲染当前显示的域名
            renderDomains(getDisplayedDomains());
        }

        // 改变视图（网格/列表）
        function changeView(e) {
            const viewType = e.currentTarget.dataset.view;
            
            // 更新按钮状态
            viewBtns.forEach(btn => {
                btn.classList.remove('active', 'bg-primary', 'text-white');
                btn.classList.add('text-gray-600', 'hover:bg-gray-100');
            });
            
            e.currentTarget.classList.add('active', 'bg-primary', 'text-white');
            e.currentTarget.classList.remove('text-gray-600', 'hover:bg-gray-100');
            
            // 改变视图
            if (viewType === 'list') {
                domainGrid.classList.remove('md:grid-cols-2', 'lg:grid-cols-3');
                domainGrid.classList.add('md:grid-cols-1');
            } else {
                domainGrid.classList.remove('md:grid-cols-1');
                domainGrid.classList.add('md:grid-cols-2', 'lg:grid-cols-3');
            }
        }

        // 显示提示消息
        function showToast(message) {
            toastMessage.textContent = message;
            successToast.classList.remove('translate-x-full');
            
            setTimeout(() => {
                successToast.classList.add('translate-x-full');
            }, 3000);
        }

        // 切换移动端菜单
        function toggleMobileMenu() {
            mobileMenu.classList.toggle('hidden');
        }

        // 检查是否需要禁用加载更多按钮
        function checkLoadMoreButton() {
            if (displayedCount >= currentDomains.length) {
                loadMoreBtn.disabled = true;
                loadMoreBtn.classList.add('opacity-50', 'cursor-not-allowed');
                loadMoreBtn.innerHTML = '没有更多域名了';
            } else {
                loadMoreBtn.disabled = false;
                loadMoreBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                loadMoreBtn.innerHTML = '加载更多 <i class="fa fa-angle-down ml-1"></i>';
            }
        }

        // 加载更多域名
        function loadMoreDomains() {
            // 增加显示数量
            displayedCount += loadMoreCount;
            
            // 确保不会超过实际数量
            if (displayedCount > currentDomains.length) {
                displayedCount = currentDomains.length;
            }
            
            // 重新渲染
            renderDomains(getDisplayedDomains());
            
            // 检查按钮状态
            checkLoadMoreButton();
            
            // 显示提示
            const loadedCount = Math.min(loadMoreCount, currentDomains.length - (displayedCount - loadMoreCount));
            showToast(`已加载 ${loadedCount} 个域名`);
        }

        // 打开购买提示模态框
        function openPurchaseModal() {
            purchaseModal.classList.remove('hidden');
            // 阻止页面滚动
            document.body.style.overflow = 'hidden';
        }

        // 关闭购买提示模态框
        function closePurchaseModal() {
            purchaseModal.classList.add('hidden');
            // 恢复页面滚动
            document.body.style.overflow = '';
        }
    </script>
</body>
</html>
