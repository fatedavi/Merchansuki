<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - Admin DakiShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#8b5cf6',
                        secondary: '#a78bfa',
                        accent: '#c084fc',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glow-effect {
            box-shadow: 0 0 20px rgba(139, 92, 246, 0.5);
        }

        .glow-effect:hover {
            box-shadow: 0 0 30px rgba(139, 92, 246, 0.8);
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1e1b4b;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8b5cf6, #a78bfa);
            border-radius: 10px;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }

        .slide-in {
            animation: slideIn 0.5s ease-out forwards;
        }

        .table-row {
            transition: all 0.3s ease;
        }

        .table-row:hover {
            background: rgba(139, 92, 246, 0.1);
            transform: scale(1.01);
        }

        .modal-backdrop {
            animation: fadeIn 0.3s ease-out;
        }

        .modal-content {
            animation: slideUp 0.3s ease-out;
        }

        @media (min-width: 640px) {
            .modal-content {
                animation: slideIn 0.3s ease-out;
            }
        }
    </style>
</head>
<body class="gradient-bg min-h-screen text-white">

    <!-- HEADER -->
    <header class="sticky top-0 z-50 glass-effect border-b border-purple-500/30 shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 py-4">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <a href="/admin/dashboard" class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center glow-effect hover:scale-110 transition-transform">
                        <i class="fas fa-arrow-left text-white"></i>
                    </a>
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent">
                            Product Management
                        </h1>
                        <p class="text-purple-300 text-xs sm:text-sm">Kelola Produk Dakimakura</p>
                    </div>
                </div>
                
                <a href="/admin/dashboard" class="glass-effect px-4 py-2 rounded-full text-sm font-medium hover:bg-white/10 transition-all flex items-center gap-2">
                    <i class="fas fa-home text-purple-400"></i>
                    <span>Dashboard</span>
                </a>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main class="container mx-auto px-4 sm:px-6 py-8 lg:py-12">

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8 slide-in">
            <div class="glass-effect rounded-xl p-4 sm:p-6 border border-purple-500/30">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center glow-effect">
                        <i class="fas fa-box text-white text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <p class="text-purple-300 text-xs">Total</p>
                        <p class="text-xl sm:text-2xl font-bold"><?= count($products) ?></p>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-xl p-4 sm:p-6 border border-green-500/30">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center glow-effect">
                        <i class="fas fa-check-circle text-white text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <p class="text-purple-300 text-xs">Active</p>
                        <p class="text-xl sm:text-2xl font-bold">
                            <?= count(array_filter($products, fn($p) => $p['status'] === 'active')) ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-xl p-4 sm:p-6 border border-yellow-500/30">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-lg flex items-center justify-center glow-effect">
                        <i class="fas fa-star text-white text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <p class="text-purple-300 text-xs">Highlight</p>
                        <p class="text-xl sm:text-2xl font-bold">
                            <?= count(array_filter($products, fn($p) => $p['highlight'] == 1)) ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="glass-effect rounded-xl p-4 sm:p-6 border border-red-500/30">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-gradient-to-br from-red-500 to-rose-500 rounded-lg flex items-center justify-center glow-effect">
                        <i class="fas fa-exclamation-triangle text-white text-lg sm:text-xl"></i>
                    </div>
                    <div>
                        <p class="text-purple-300 text-xs">Low Stock</p>
                        <p class="text-xl sm:text-2xl font-bold">
                            <?= count(array_filter($products, fn($p) => $p['stock'] < 10)) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="glass-effect rounded-xl p-4 sm:p-6 mb-6 border border-purple-500/30 slide-in" style="animation-delay: 0.1s;">
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="relative w-full sm:w-96">
                    <input 
                        type="text" 
                        id="searchInput"
                        placeholder="Cari produk..." 
                        class="w-full pl-10 pr-4 py-3 glass-effect rounded-lg text-white placeholder-purple-300 focus:outline-none border border-purple-500/30 focus:border-purple-500 transition-all text-sm"
                    >
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-purple-400"></i>
                </div>
                
                <div class="flex gap-2 sm:gap-3 w-full sm:w-auto">
                    <select id="statusFilter" class="flex-1 sm:flex-none glass-effect px-4 py-3 rounded-lg text-white border border-purple-500/30 focus:outline-none focus:border-purple-500 transition-all text-sm">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="preorder">Pre-Order</option>
                    </select>
                    
                    <button onclick="openAddModal()" class="flex-1 sm:flex-none bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 px-4 sm:px-6 py-3 rounded-lg font-semibold transition-all glow-effect flex items-center justify-center gap-2 text-sm whitespace-nowrap">
                        <i class="fas fa-plus"></i>
                        <span>Add Product</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="glass-effect rounded-xl border border-purple-500/30 overflow-hidden slide-in" style="animation-delay: 0.2s;">
            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-purple-900/30 border-b border-purple-500/30">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-purple-300 uppercase">Image</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-purple-300 uppercase">Product</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-purple-300 uppercase">Price</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-purple-300 uppercase">Stock</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-purple-300 uppercase">Rating</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-purple-300 uppercase">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-purple-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                            <tr class="table-row border-b border-purple-500/20" data-name="<?= strtolower($product['name']) ?>" data-status="<?= $product['status'] ?>">
                                <td class="px-6 py-4">
                                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center overflow-hidden">
                                        <?php if ($product['image']): ?>
                                            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <i class="fas fa-image text-white text-2xl"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-2">
                                        <div>
                                            <h3 class="font-semibold text-white mb-1"><?= htmlspecialchars($product['name']) ?></h3>
                                            <p class="text-xs text-purple-300 line-clamp-1"><?= htmlspecialchars($product['description'] ?? '-') ?></p>
                                            <?php if ($product['highlight']): ?>
                                                <span class="inline-block mt-1 px-2 py-0.5 bg-yellow-500/20 text-yellow-400 text-xs rounded-full">
                                                    <i class="fas fa-star"></i> Featured
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="font-bold text-purple-400">Rp <?= number_format($product['price'], 0, ',', '.') ?></span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?= $product['stock'] < 10 ? 'bg-red-500/20 text-red-400' : 'bg-green-500/20 text-green-400' ?>">
                                        <?= $product['stock'] ?> pcs
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="font-semibold"><?= $product['rating'] ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php
                                    $statusColors = [
                                        'active' => 'from-green-500 to-emerald-500',
                                        'inactive' => 'from-red-500 to-rose-500',
                                        'preorder' => 'from-blue-500 to-indigo-500'
                                    ];
                                    $statusIcons = [
                                        'active' => 'fa-check-circle',
                                        'inactive' => 'fa-times-circle',
                                        'preorder' => 'fa-clock'
                                    ];
                                    ?>
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r <?= $statusColors[$product['status']] ?>">
                                        <i class="fas <?= $statusIcons[$product['status']] ?>"></i>
                                        <?= ucfirst($product['status']) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick='openEditModal(<?= json_encode($product) ?>)' 
                                           class="w-9 h-9 bg-blue-500/20 hover:bg-blue-500/30 rounded-lg flex items-center justify-center transition-all group"
                                           title="Edit">
                                            <i class="fas fa-edit text-blue-400 group-hover:scale-110 transition-transform"></i>
                                        </button>
                                        <button onclick='viewProduct(<?= json_encode($product) ?>)' 
                                           class="w-9 h-9 bg-green-500/20 hover:bg-green-500/30 rounded-lg flex items-center justify-center transition-all group"
                                           title="View">
                                            <i class="fas fa-eye text-green-400 group-hover:scale-110 transition-transform"></i>
                                        </button>
                                        <a href="/admin/products/delete/<?= $product['id'] ?>" 
                                           class="w-9 h-9 bg-red-500/20 hover:bg-red-500/30 rounded-lg flex items-center justify-center transition-all group"
                                           onclick="return confirm('Yakin hapus produk ini?')"
                                           title="Delete">
                                            <i class="fas fa-trash text-red-400 group-hover:scale-110 transition-transform"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-12">
                                <i class="fas fa-box-open text-6xl text-purple-400/30 mb-4"></i>
                                <p class="text-purple-200">Belum ada produk</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="lg:hidden space-y-4 p-4" id="productCards">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="glass-effect rounded-xl p-4 border border-purple-500/30" data-name="<?= strtolower($product['name']) ?>" data-status="<?= $product['status'] ?>">
                            <div class="flex gap-3 mb-3">
                                <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    <?php if ($product['image']): ?>
                                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <i class="fas fa-image text-white text-2xl"></i>
                                    <?php endif; ?>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-sm mb-1 line-clamp-1"><?= htmlspecialchars($product['name']) ?></h3>
                                    <p class="text-xs text-purple-300 line-clamp-2 mb-2"><?= htmlspecialchars($product['description'] ?? '-') ?></p>
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <?php
                                        $statusColors = [
                                            'active' => 'from-green-500 to-emerald-500',
                                            'inactive' => 'from-red-500 to-rose-500',
                                            'preorder' => 'from-blue-500 to-indigo-500'
                                        ];
                                        ?>
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-gradient-to-r <?= $statusColors[$product['status']] ?>">
                                            <?= ucfirst($product['status']) ?>
                                        </span>
                                        <?php if ($product['highlight']): ?>
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-500/20 text-yellow-400 text-xs rounded-full">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2 mb-3 text-xs">
                                <div class="glass-effect p-2 rounded-lg text-center">
                                    <p class="text-purple-300 mb-1">Price</p>
                                    <p class="font-bold text-purple-400">Rp <?= number_format($product['price'] / 1000, 0) ?>K</p>
                                </div>
                                <div class="glass-effect p-2 rounded-lg text-center">
                                    <p class="text-purple-300 mb-1">Stock</p>
                                    <p class="font-bold <?= $product['stock'] < 10 ? 'text-red-400' : 'text-green-400' ?>"><?= $product['stock'] ?> pcs</p>
                                </div>
                                <div class="glass-effect p-2 rounded-lg text-center">
                                    <p class="text-purple-300 mb-1">Rating</p>
                                    <p class="font-bold text-yellow-400"><i class="fas fa-star"></i> <?= $product['rating'] ?></p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-3 gap-2">
                                <button onclick='openEditModal(<?= json_encode($product) ?>)' 
                                   class="bg-blue-500/20 hover:bg-blue-500/30 py-2 rounded-lg transition-all flex items-center justify-center gap-1 text-sm">
                                    <i class="fas fa-edit text-blue-400"></i>
                                </button>
                                <button onclick='viewProduct(<?= json_encode($product) ?>)' 
                                   class="bg-green-500/20 hover:bg-green-500/30 py-2 rounded-lg transition-all flex items-center justify-center gap-1 text-sm">
                                    <i class="fas fa-eye text-green-400"></i>
                                </button>
                                <a href="/admin/products/delete/<?= $product['id'] ?>" 
                                   class="bg-red-500/20 hover:bg-red-500/30 py-2 rounded-lg transition-all flex items-center justify-center gap-1 text-sm"
                                   onclick="return confirm('Yakin hapus produk ini?')">
                                    <i class="fas fa-trash text-red-400"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-12">
                        <i class="fas fa-box-open text-6xl text-purple-400/30 mb-4"></i>
                        <p class="text-purple-200">Belum ada produk</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </main>

    <!-- Modal Add/Edit Product -->
    <div id="productModal" class="fixed inset-0 z-50 hidden">
        <div class="modal-backdrop absolute inset-0 bg-black/70 backdrop-blur-sm" onclick="closeProductModal()"></div>
        
        <div class="relative h-full flex items-end sm:items-center justify-center p-0 sm:p-4">
            <div class="modal-content glass-effect w-full sm:max-w-2xl sm:rounded-2xl rounded-t-3xl sm:rounded-b-2xl border border-purple-500/30 shadow-2xl max-h-[90vh] overflow-y-auto">
                <div class="sticky top-0 glass-effect border-b border-purple-500/30 p-4 sm:p-6 flex items-center justify-between rounded-t-3xl sm:rounded-t-2xl z-10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center glow-effect">
                            <i class="fas fa-box text-white"></i>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold bg-gradient-to-r from-purple-400 to-pink-400 bg-clip-text text-transparent" id="modalTitle">
                            Add Product
                        </h2>
                    </div>
                    <button onclick="closeProductModal()" class="w-8 h-8 sm:w-10 sm:h-10 glass-effect hover:bg-red-500/20 rounded-full flex items-center justify-center transition-all">
                        <i class="fas fa-times text-red-400 text-lg"></i>
                    </button>
                </div>

                <form id="productForm" action="<?php echo isset($product['id']) ? '/admin/products/update/' . $product['id'] : '/admin/products/store'; ?>" method="POST" enctype="multipart/form-data" class="p-4 sm:p-6 space-y-4">
                    <input type="hidden" name="id" id="productId" value="<?php echo isset($product['id']) ? $product['id'] : ''; ?>">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Product Name -->
                        <div class="sm:col-span-2">
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-tag text-purple-400"></i>
                                Product Name
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="productName" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white placeholder-purple-300 focus:outline-none border border-purple-500/30 focus:border-purple-500 transition-all text-sm"
                                placeholder="Sakura Dream Dakimakura"
                                required
                            >
                        </div>

                        <!-- Category -->
                        <div>
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-folder text-purple-400"></i>
                                Category
                            </label>
                            <select 
                                name="category_id" 
                                id="productCategory" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white border border-purple-500/30 focus:outline-none focus:border-purple-500 transition-all text-sm"
                                required
                            >
                                <option value="">Select Category</option>
                                <!-- PHP: Loop categories here -->
                                <option value="1">Dakimakura</option>
                                <option value="2">Playmat</option>
                                <option value="3">Poster</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div>
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-dollar-sign text-purple-400"></i>
                                Price (Rp)
                            </label>
                            <input 
                                type="number" 
                                name="price" 
                                id="productPrice" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white placeholder-purple-300 focus:outline-none border border-purple-500/30 focus:border-purple-500 transition-all text-sm"
                                placeholder="450000"
                                required
                            >
                        </div>

                        <!-- Stock -->
                        <div>
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-boxes text-purple-400"></i>
                                Stock
                            </label>
                            <input 
                                type="number" 
                                name="stock" 
                                id="productStock" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white placeholder-purple-300 focus:outline-none border border-purple-500/30 focus:border-purple-500 transition-all text-sm"
                                placeholder="50"
                                value="0"
                            >
                        </div>

                        <!-- Rating -->
                        <div>
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-star text-purple-400"></i>
                                Rating
                            </label>
                            <input 
                                type="number" 
                                name="rating" 
                                id="productRating" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white placeholder-purple-300 focus:outline-none border border-purple-500/30 focus:border-purple-500 transition-all text-sm"
                                placeholder="4.8"
                                step="0.1"
                                min="0"
                                max="5"
                                value="0.0"
                            >
                        </div>
                        <div>
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-info-circle text-purple-400"></i>
                                Status
                            </label>
                            <select 
                                name="status" 
                                id="productStatus" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white border border-purple-500/30 focus:outline-none focus:border-purple-500 transition-all text-sm"
                                required
                            >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="preorder">Pre-Order</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-image text-purple-400"></i>
                                Product Image
                            </label>
                            <div class="flex items-center justify-center w-full">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-purple-500/30 border-dashed rounded-lg cursor-pointer hover:bg-white/5 transition-all">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <i class="fas fa-cloud-upload-alt text-purple-400 text-2xl mb-2"></i>
                                        <p class="text-xs text-purple-300">Click to upload or drag and drop</p>
                                    </div>
                                    <input type="file" name="image" id="imageInput" class="hidden" accept="image/*" onchange="previewImage(this)" />
                                </label>
                            </div>
                            <div id="imagePreview" class="hidden mt-4">
                                <img src="" id="previewImg" class="w-full h-40 object-cover rounded-lg border border-purple-500/30">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block mb-2 font-semibold text-sm flex items-center gap-2">
                                <i class="fas fa-align-left text-purple-400"></i>
                                Description
                            </label>
                            <textarea 
                                name="description" 
                                id="productDescription" 
                                rows="4" 
                                class="w-full px-4 py-3 glass-effect rounded-lg text-white placeholder-purple-300 focus:outline-none border border-purple-500/30 focus:border-purple-500 transition-all text-sm"
                                placeholder="Tuliskan deskripsi lengkap produk..."
                            ></textarea>
                        </div>

                        <div class="sm:col-span-2 flex items-center gap-3 glass-effect p-4 rounded-lg border border-purple-500/30">
                            <input 
                                type="checkbox" 
                                name="highlight" 
                                id="productHighlight" 
                                value="1"
                                class="w-5 h-5 rounded border-purple-500/30 text-purple-600 focus:ring-purple-500 bg-transparent"
                            >
                            <label for="productHighlight" class="text-sm font-medium">
                                Highlight Product (Muncul di halaman utama/Featured)
                            </label>
                        </div>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" onclick="closeProductModal()" class="flex-1 px-6 py-3 rounded-lg font-semibold glass-effect hover:bg-white/10 transition-all text-sm">
                            Cancel
                        </button>
                        <button type="submit" class="flex-[2] bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 px-6 py-3 rounded-lg font-bold transition-all glow-effect text-sm">
                            Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal & Form Logic
        const modal = document.getElementById('productModal');
        const form = document.getElementById('productForm');
        const modalTitle = document.getElementById('modalTitle');
        const previewImg = document.getElementById('previewImg');
        const imagePreviewDiv = document.getElementById('imagePreview');

        function openAddModal() {
            modalTitle.innerText = "Add New Product";
            form.reset();
            document.getElementById('productId').value = '';
            imagePreviewDiv.classList.add('hidden');
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function openEditModal(product) {
            modalTitle.innerText = "Edit Product";
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Fill Form
            document.getElementById('productId').value = product.id;
            document.getElementById('productName').value = product.name;
            document.getElementById('productCategory').value = product.category_id;
            document.getElementById('productPrice').value = product.price;
            document.getElementById('productStock').value = product.stock;
            document.getElementById('productRating').value = product.rating;
            document.getElementById('productStatus').value = product.status;
            document.getElementById('productDescription').value = product.description;
            document.getElementById('productHighlight').checked = product.highlight == 1;
            // slug
            if(document.getElementById('productSlug')) {
                document.getElementById('productSlug').value = product.slug ?? '';
            }
            // image
            if(product.image) {
                previewImg.src = product.image;
                imagePreviewDiv.classList.remove('hidden');
            } else {
                imagePreviewDiv.classList.add('hidden');
            }
        }

        function closeProductModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreviewDiv.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Search & Filter Real-time
        const searchInput = document.getElementById('searchInput');
        const statusFilter = document.getElementById('statusFilter');

        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusTerm = statusFilter.value;
            
            // Filter Table Rows (Desktop)
            document.querySelectorAll('#productTableBody tr').forEach(row => {
                const name = row.getAttribute('data-name');
                const status = row.getAttribute('data-status');
                const matchesSearch = name.includes(searchTerm);
                const matchesStatus = statusTerm === "" || status === statusTerm;
                
                row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });

            // Filter Cards (Mobile)
            document.querySelectorAll('#productCards > div').forEach(card => {
                const name = card.getAttribute('data-name');
                const status = card.getAttribute('data-status');
                const matchesSearch = name.includes(searchTerm);
                const matchesStatus = statusTerm === "" || status === statusTerm;
                
                card.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', filterProducts);
        statusFilter.addEventListener('change', filterProducts);

        // View Detail Product (Simple Alert/Log for now)
        function viewProduct(product) {
            alert(`Product: ${product.name}\nPrice: Rp ${product.price}\nStock: ${product.stock}\nRating: ${product.rating}`);
        }
    </script>
</body>
</html>