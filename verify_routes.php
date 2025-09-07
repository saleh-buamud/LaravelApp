<?php

/**
 * Route Verification Script
 * 
 * This script verifies that all route files are properly included
 * and that the route structure is correct.
 */

echo "🔍 Verifying Route Structure\n";
echo "============================\n\n";

// Check if route files exist
$routeFiles = [
    'routes/api.php',
    'routes/api/products.php',
    'routes/api/categories.php',
    'routes/api/subcategories.php',
    'routes/api/cart.php',
    'routes/api/orders.php',
    'routes/api/admin.php'
];

echo "📁 Checking Route Files:\n";
foreach ($routeFiles as $file) {
    if (file_exists($file)) {
        echo "✅ {$file} - EXISTS\n";
    } else {
        echo "❌ {$file} - MISSING\n";
    }
}

echo "\n";

// Check main api.php content
echo "📄 Checking Main API File Content:\n";
if (file_exists('routes/api.php')) {
    $content = file_get_contents('routes/api.php');
    
    $requiredIncludes = [
        "require __DIR__ . '/api/products.php';",
        "require __DIR__ . '/api/categories.php';",
        "require __DIR__ . '/api/subcategories.php';",
        "require __DIR__ . '/api/cart.php';",
        "require __DIR__ . '/api/orders.php';",
        "require __DIR__ . '/api/admin.php';"
    ];
    
    foreach ($requiredIncludes as $include) {
        if (strpos($content, $include) !== false) {
            echo "✅ {$include}\n";
        } else {
            echo "❌ {$include} - NOT FOUND\n";
        }
    }
} else {
    echo "❌ routes/api.php not found\n";
}

echo "\n";

// Check route file structure
echo "🏗️ Checking Route File Structure:\n";
$domainFiles = [
    'routes/api/products.php' => 'ProductController',
    'routes/api/categories.php' => 'CategoryController',
    'routes/api/subcategories.php' => 'SubCategoryController',
    'routes/api/cart.php' => 'CartController',
    'routes/api/orders.php' => 'OrderController',
    'routes/api/admin.php' => 'ProductController, CategoryController'
];

foreach ($domainFiles as $file => $expectedController) {
    if (file_exists($file)) {
        $content = file_get_contents($file);
        
        // Check for proper structure
        $checks = [
            'Has proper PHP opening tag' => strpos($content, '<?php') === 0,
            'Has Route facade import' => strpos($content, 'use Illuminate\Support\Facades\Route;') !== false,
            'Has controller import' => strpos($content, 'use App\Http\Controllers\Api\\') !== false,
            'Has Route::prefix' => strpos($content, 'Route::prefix(') !== false,
            'Has proper comments' => strpos($content, '/*') !== false
        ];
        
        echo "📄 {$file}:\n";
        foreach ($checks as $check => $result) {
            if ($result) {
                echo "  ✅ {$check}\n";
            } else {
                echo "  ❌ {$check}\n";
            }
        }
        echo "\n";
    }
}

echo "🎯 Route Structure Verification Complete!\n";
echo "\n";
echo "💡 Next Steps:\n";
echo "1. Run 'php artisan route:list --path=api' to see all registered routes\n";
echo "2. Test the API endpoints using the test_routes.php script\n";
echo "3. Verify that your frontend can still access all endpoints\n";
