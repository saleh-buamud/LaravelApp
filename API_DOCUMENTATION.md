# Laravel E-commerce API Documentation

## Overview
This is a RESTful API for an e-commerce application built with Laravel. The API follows clean architecture principles with proper separation of concerns using Services, Repositories, and API Resources.

## Base URL
```
http://your-domain.com/api
```

## Authentication
The API uses Laravel Sanctum for authentication. Include the Bearer token in the Authorization header:
```
Authorization: Bearer {your-token}
```

## Response Format
All API responses follow a consistent format:

### Success Response
```json
{
    "success": true,
    "message": "Operation completed successfully",
    "data": { ... },
    "meta": { ... } // Only for paginated responses
}
```

### Error Response
```json
{
    "success": false,
    "message": "Error description",
    "errors": { ... } // Only for validation errors
}
```

## Endpoints

### Products

#### Get All Products
```
GET /api/products
```

**Query Parameters:**
- `per_page` (optional): Number of items per page (default: 15)

**Response:**
```json
{
    "success": true,
    "message": "Products retrieved successfully",
    "data": [
        {
            "id": 1,
            "name": "Product Name",
            "description": "Product Description",
            "quantity": 10,
            "price": "99.99",
            "image": "http://domain.com/storage/products/image.jpg",
            "sub_category": {
                "id": 1,
                "name": "SubCategory Name",
                "category": {
                    "id": 1,
                    "name": "Category Name"
                }
            },
            "created_at": "2024-01-01T00:00:00.000000Z",
            "updated_at": "2024-01-01T00:00:00.000000Z"
        }
    ],
    "meta": {
        "current_page": 1,
        "last_page": 5,
        "per_page": 15,
        "total": 75
    }
}
```

#### Get Product by ID
```
GET /api/products/{id}
```

#### Search Products
```
GET /api/products/search?keyword=search_term
```

**Query Parameters:**
- `keyword` (required): Search term
- `per_page` (optional): Number of items per page

#### Get Products by Sub Category
```
GET /api/products/sub-category/{subCategoryId}
```

#### Get Low Stock Products
```
GET /api/products/low-stock?threshold=5
```

**Query Parameters:**
- `threshold` (optional): Stock threshold (default: 5)

#### Create Product (Admin Only)
```
POST /api/admin/products
```

**Request Body:**
```json
{
    "name": "Product Name",
    "description": "Product Description",
    "quantity": 10,
    "price": 99.99,
    "image": "file", // Multipart file upload
    "sub_category_id": 1
}
```

#### Update Product (Admin Only)
```
PUT /api/admin/products/{id}
```

#### Delete Product (Admin Only)
```
DELETE /api/admin/products/{id}
```

### Categories

#### Get All Categories
```
GET /api/categories
```

#### Get Category by ID
```
GET /api/categories/{id}
```

#### Create Category (Admin Only)
```
POST /api/admin/categories
```

**Request Body:**
```json
{
    "name": "Category Name",
    "description": "Category Description",
    "image": "file" // Multipart file upload
}
```

#### Update Category (Admin Only)
```
PUT /api/admin/categories/{id}
```

#### Delete Category (Admin Only)
```
DELETE /api/admin/categories/{id}
```

### Sub Categories

#### Get All Sub Categories
```
GET /api/subcategories
```

#### Get Sub Category by ID
```
GET /api/subcategories/{id}
```

#### Get Sub Categories by Category
```
GET /api/subcategories/category/{categoryId}
```

### Cart

#### Get Cart Contents
```
GET /api/cart
```

#### Get Cart Summary
```
GET /api/cart/summary
```

#### Add Item to Cart
```
POST /api/cart/add/{productId}
```

**Request Body:**
```json
{
    "quantity": 1
}
```

#### Update Item Quantity
```
PUT /api/cart/update/{productId}
```

**Request Body:**
```json
{
    "quantity": 2
}
```

#### Remove Item from Cart
```
DELETE /api/cart/remove/{productId}
```

#### Clear Cart
```
DELETE /api/cart/clear
```

### Orders

#### Get All Orders (Authenticated)
```
GET /api/orders
```

#### Create Order (Authenticated)
```
POST /api/orders
```

**Request Body:**
```json
{
    "items": [
        {
            "product_id": 1,
            "quantity": 2,
            "price": 99.99
        }
    ]
}
```

#### Get Order by ID (Authenticated)
```
GET /api/orders/{id}
```

#### Get Orders by User (Authenticated)
```
GET /api/orders/user/{userId}
```

#### Update Order Status (Authenticated)
```
PATCH /api/orders/{id}/status
```

**Request Body:**
```json
{
    "status": 2
}
```

**Status Codes:**
- 1: Pending
- 2: Processing
- 3: Shipped
- 4: Delivered
- 5: Cancelled

#### Delete Order (Authenticated)
```
DELETE /api/orders/{id}
```

## Error Codes

| Code | Description |
|------|-------------|
| 200  | Success |
| 201  | Created |
| 400  | Bad Request |
| 401  | Unauthorized |
| 403  | Forbidden |
| 404  | Not Found |
| 405  | Method Not Allowed |
| 422  | Validation Error |
| 500  | Internal Server Error |

## Rate Limiting
API endpoints are rate limited. Check the response headers for rate limit information:
- `X-RateLimit-Limit`: Maximum requests per minute
- `X-RateLimit-Remaining`: Remaining requests in current window

## File Uploads
For endpoints that accept file uploads (images), use `multipart/form-data` content type.

## Pagination
Paginated responses include a `meta` object with pagination information:
- `current_page`: Current page number
- `last_page`: Last page number
- `per_page`: Items per page
- `total`: Total number of items

## Examples

### Creating an Order
```bash
curl -X POST http://your-domain.com/api/orders \
  -H "Authorization: Bearer your-token" \
  -H "Content-Type: application/json" \
  -d '{
    "items": [
      {
        "product_id": 1,
        "quantity": 2,
        "price": 99.99
      }
    ]
  }'
```

### Adding Item to Cart
```bash
curl -X POST http://your-domain.com/api/cart/add/1 \
  -H "Content-Type: application/json" \
  -d '{
    "quantity": 1
  }'
```

### Searching Products
```bash
curl -X GET "http://your-domain.com/api/products/search?keyword=laptop&per_page=10"
```
