# Contractor API List

## Authentication

### 1. Register

- URL: `/api/contractor/auth/register`
- Method: `POST`
- Request body:
  - `name`: string
  - `username`: string
  - `email`: string
  - `password`: string
  - `password_confirmation`: string
  - `profile_image`: file (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 31,
        "name": "Richard Asmarakandi",
        "username": "richard",
        "email": "richard@gmail.com",
        "role": "contractor",
        "profile_url": "http://127.0.0.1:8000/images/user-default.png"
    }
}
```
**Example validation error response**
```json
{
    "success": false,
    "message": "Validation Error",
    "data": {
        "username": [
            "The username has already been taken."
        ],
        "email": [
            "The email has already been taken."
        ]
    }
}
```

### 2. Login

- URL: `/api/contractor/auth/login`
- Method: `POST`
- Request body:
  - `email`: string, email or username
  - `password`: string

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "name": "M. Auliya Mirzaq Romdloni",
        "username": "mirzaq19",
        "email": "mirzaqarjap@gmail.com",
        "role": "contractor",
        "profile_url": "https://quliku.com/storage/profile_images/mirzaq19.jpg",
        "token": "2|rhUBav6dI0nwN1nbDzx9VOhys6NdRXFIQMN2ERrp"
    }
}
```
**Example invalid credential error response**
```json
{
    "success": false,
    "message": "1000:Invalid credentials",
    "data": {
        "message": "Invalid credentials",
        "code": 1000
    }
}
```

### 3. Get user data

- URL: `/api/contractor/auth/me`
- Method: `GET`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "name": "M. Auliya Mirzaq Romdloni",
        "username": "mirzaq19",
        "email": "mirzaqarjap@gmail.com",
        "role": "contractor",
        "profile_url": "https://quliku.com/storage/profile_images/mirzaq19.jpg"
    }
}
```

### 4. Update user data

- URL: `/api/contractor/auth/update`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**
- Request body:
  - `name`: string
  - `email`: string
  - `password`: string (opsional)
  - `password_confirmation`: string (opsional)
  - `profile_image`: file (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 2,
        "name": "M. Auliya Mirzaq",
        "username": "mirzaq19",
        "email": "mirzaqarjap@gmail.com",
        "role": "contractor",
        "profile_url": "https://quliku.com/storage/profile_images/mirzaq19.jpg"
    }
}
```
**Example validation error response**
```json
{
    "success": false,
    "message": "Validation Error",
    "data": {
        "email": [
            "The email field is required."
        ]
    }
}
```

### 5. Logout

- URL: `/api/contractor/auth/logout`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```

## Foreman

### 1. Search foreman

- URL: `/api/contractor/foreman/search`
- Method: `GET`
- Parameters:
  - `name`: string
  - `classification`: string [`water` | `craft` | `infra`] (opsional)
  - `city`: string (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png",
            "rating": 4,
            "details": {
                "subscription": "regular",
                "is_work": 0,
                "city": "Mojokerto",
                "wa_number": "082234260055",
                "classification": "craft",
                "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
                "experience": 12,
                "min_people": 40,
                "max_people": 70,
                "price": "1200000.00"
            }
        }
    ]
}
```

### 2. Recommendation foreman

- URL: `/api/contractor/foreman/recommendation`
- Method: `GET`

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png",
            "rating": 4,
            "details": {
                "subscription": "regular",
                "is_work": 0,
                "city": "Mojokerto",
                "wa_number": "082234260055",
                "classification": "craft",
                "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
                "experience": 12,
                "min_people": 40,
                "max_people": 70,
                "price": "1200000.00"
            }
        },
        "..."
    ]
}
```

### 3. Detail foreman

- URL: `/api/contractor/foreman/detail/{id}`
- Method: `GET`
- Headers:
  - Authorization: Bearer **{token}**

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 33,
        "name": "Budi Purwanto",
        "username": "budi.purwa",
        "email": "budi@gmail.com",
        "role": "foreman",
        "profile_url": "http://127.0.0.1:8000/images/user-default.png",
        "rating": 4,
        "details": {
            "subscription": "regular",
            "is_work": 0,
            "city": "Mojokerto",
            "wa_number": "082234260055",
            "classification": "craft",
            "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
            "experience": 12,
            "min_people": 40,
            "max_people": 70,
            "price": "1200000.00",
            "bank_type": "BRI",
            "account_name": "Budi Purwanto",
            "account_number": "0385562987452"
        },
        "images": [
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/budi.purwa-1660385897517.jpg",
                "type": "ktp"
            },
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/budi.purwa-1660385897676.jpg",
                "type": "certificate"
            },
            {
                "photo_url": "http://127.0.0.1:8000/storage/foreman_images/budi.purwa-1660385897690.jpg",
                "type": "portfolio"
            }
        ],
        "comments": [
            {
                "name": "M. Auliya Mirzaq Romdloni",
                "rating": 4,
                "description": "Hasil jadinya sangat memuaskan"
            }
        ],
        "in_wishlist": false
    }
}
```
**Example not found error response**
```json
{
    "success": false,
    "message": "1004:Foreman not found",
    "data": {
        "message": "Foreman not found",
        "code": 1004
    }
}
```

### 4. Wishlist foreman

- URL: `/api/contractor/foreman/wishlist`
- Method: `GET`
- Headers:
    - Authorization: Bearer **{token}**
- Parameters:
    - `classification`: string [`water` | `craft` | `infra`] (opsional)
    - `city`: string (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png",
            "rating": 4,
            "details": {
                "subscription": "regular",
                "is_work": 0,
                "city": "Mojokerto",
                "wa_number": "082234260055",
                "classification": "craft",
                "description": "Saya berpengalaman dalam hiasan eksterior maupun interior bangunan",
                "experience": 12,
                "min_people": 40,
                "max_people": 70,
                "price": "1200000.00",
                "bank_type": "BRI",
                "account_name": "Budi Purwanto",
                "account_number": "0385562987452"
            },
            "comments": [
                {
                    "name": "M. Auliya Mirzaq Romdloni",
                    "rating": 4,
                    "description": "Hasil jadinya sangat memuaskan"
                }
            ]
        }
    ]
}
```

### 5. Add foreman to wishlist 

- URL: `/api/contractor/foreman/wishlist`
- Method: `POST`
- Headers:
    - Authorization: Bearer **{token}**
- Request body:
    - `foreman_id`: integer

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```

### 6. Remove foreman to wishlist

- URL: `/api/contractor/foreman/wishlist`
- Method: `DELETE`
- Headers:
    - Authorization: Bearer **{token}**
- Request body:
    - `foreman_id`: integer

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```

## Project

### 1. Detail project

- URL: `/api/contractor/project/detail/{id}`
- Method: `GET`

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 8,
        "name": "Bangun pager besi",
        "description": "Nambah pager besi depan rumah",
        "status": "review",
        "start_date": "2022-09-25",
        "end_date": "2022-10-24",
        "province": "Jawa Timur",
        "city": "Mojokerto",
        "district": "Sooko",
        "village": "Japan",
        "address": "Perum Japan Raya Jl. Bola Volly A.20",
        "total_price": 7000000,
        "document_url": "https://dashboard.binderbyte.com",
        "fix_people": 3,
        "transportation_fee": 500000,
        "already_paid": null,
        "payment_type": "bulk",
        "wa_number": "087738462285",
        "created_at": "2022-08-13 18:15:32",
        "updated_at": "2022-08-15 18:33:42",
        "rating": {
            "name": "M. Auliya Mirzaq Romdloni",
            "rating": 4,
            "description": "Hasil jadinya sangat memuaskan"
        },
        "reports": [
            {
                "id": 5,
                "user_id": 33,
                "project_id": 8,
                "percentage": 20,
                "description": "Sejauh ini berjalan lancar",
                "images": [
                    "http://127.0.0.1:8000/storage/project/8/report/166039843998.png",
                    "http://127.0.0.1:8000/storage/project/8/report/166039843918.png"
                ]
            },
            {
                "id": 6,
                "user_id": 33,
                "project_id": 8,
                "percentage": 30,
                "description": "Ada beberapa kendala pada batu bata, jadi cukup memakan waktu",
                "images": [
                    "http://127.0.0.1:8000/storage/project/8/report/166039870934.png",
                    "http://127.0.0.1:8000/storage/project/8/report/166039870981.png"
                ]
            },
            {
                "id": 7,
                "user_id": 33,
                "project_id": 8,
                "percentage": 100,
                "description": "Pembangunan sudah selesai",
                "images": [
                    "http://127.0.0.1:8000/storage/project/8/report/166056060220.png"
                ]
            }
        ],
        "payments": [
            {
                "id": 1,
                "user_id": 31,
                "project_id": 8,
                "photo_url": "http://127.0.0.1:8000/storage/project/8/payment/166039054194.jpg",
                "amount": 1000000,
                "status": "verified",
                "description": "Transfer 1000000"
            }
        ],
        "contractor": {
            "id": 31,
            "name": "M. Auliya Mirzaq Romdloni",
            "username": "mirzaq19",
            "email": "mirzaqarjap@gmail.com",
            "role": "contractor",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png"
        },
        "foreman": {
            "id": 33,
            "name": "Budi Purwanto",
            "username": "budi.purwa",
            "email": "budi@gmail.com",
            "role": "foreman",
            "profile_url": "http://127.0.0.1:8000/images/user-default.png"
        }
    }
}
```

**Example not found error response**
```json
{
    "success": false,
    "message": "1003:Project not found",
    "data": {
        "message": "Project not found",
        "code": 1003
    }
}
```

### 2. List project

- URL: `/api/contractor/project/list`
- Method: `GET`
- Headers:
  - Authorization: Bearer **{token}**
- Parameters:
  - `status`: string [ `waiting` | `not_paid` | `ongoing` | `done` | `reject` | `review`] (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": [
        {
            "id": 8,
            "name": "Bangun pager besi",
            "description": "Nambah pager besi depan rumah",
            "status": "review",
            "start_date": "2022-09-25",
            "end_date": "2022-10-24",
            "province": "Jawa Timur",
            "city": "Mojokerto",
            "district": "Sooko",
            "village": "Japan",
            "address": "Perum Japan Raya Jl. Bola Volly A.20",
            "total_price": 7000000,
            "document_url": "https://dashboard.binderbyte.com",
            "fix_people": 3,
            "transportation_fee": 500000,
            "already_paid": null,
            "payment_type": "bulk",
            "wa_number": "087738462285",
            "created_at": "2022-08-13 18:15:32",
            "updated_at": "2022-08-15 18:33:42",
            "foreman": {
                "id": 33,
                "name": "Budi Purwanto",
                "username": "budi.purwa",
                "email": "budi@gmail.com",
                "role": "foreman",
                "profile_url": "http://127.0.0.1:8000/images/user-default.png"
            }
        }
    ]
}
```

### 3. Create project

- URL: `/api/contractor/project/create`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**
- Request body:
  - `foreman_id`: int
  - `name`: string
  - `description`: string (opsional)
  - `start_date`: date [YYYY-MM-DD]
  - `end_date`: date [YYYY-MM-DD]
  - `province`: string
  - `city`: string
  - `district`: string
  - `village`: string
  - `address`: string
  - `total_price`: integer
  - `document_url`: string (opsional)
  - `payment_type`: string [ `bulk` | `daily` ]
  - `wa_number`: string

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 9,
        "name": "Bangun kolam renang dalam",
        "description": "Bangun kolam renang dengan ukuran 5x10 m dengan tema hiasan ornamen kayu",
        "status": "waiting",
        "start_date": "2022-06-25",
        "end_date": "2022-12-30",
        "province": "jawa timur",
        "city": "mojokerto",
        "district": "sooko",
        "village": "japan",
        "address": "Perum Japan Raya Jl. Bola Volly A.20",
        "total_price": 17500000,
        "document_url": "https://dashboard.binderbyte.com",
        "fix_people": null,
        "transportation_fee": null,
        "already_paid": null,
        "payment_type": "daily",
        "wa_number": "087738462285",
        "created_at": "2022-08-20 10:59:48",
        "updated_at": "2022-08-20 10:59:48"
    }
}
```

**Example foreman not found error response**
```json
{
    "success": false,
    "message": "Validation Error",
    "data": {
        "foreman_id": [
            "The selected foreman id is invalid."
        ]
    }
}
```

**Example user does not have a contractor role response**
```json
{
    "success": false,
    "message": "1001:You are not authorized to create project",
    "data": {
        "message": "You are not authorized to create project",
        "code": 1001
    }
}
```

**Example if foreman work in another project response**
```json
{
    "success": false,
    "message": "1002:Foreman is working in another project",
    "data": {
        "message": "Foreman is working in another project",
        "code": 1002
    }
}
```

### 4. Cancel project

- URL: `/api/contractor/project/cancel`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**
- Request body:
  - `project_id`: int

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 9,
        "name": "Bangun kolam renang dalam",
        "description": "Bangun kolam renang dengan ukuran 5x10 m dengan tema hiasan ornamen kayu",
        "status": "reject",
        "rejected_reason": "Project canceled by contractor",
        "start_date": "2022-06-25",
        "end_date": "2022-12-30",
        "province": "jawa timur",
        "city": "mojokerto",
        "district": "sooko",
        "village": "japan",
        "address": "Perum Japan Raya Jl. Bola Volly A.20",
        "total_price": 17500000,
        "document_url": "https://dashboard.binderbyte.com",
        "fix_people": null,
        "transportation_fee": null,
        "already_paid": null,
        "payment_type": "daily",
        "wa_number": "087738462285",
        "created_at": "2022-08-20 10:59:48",
        "updated_at": "2022-08-20 11:08:59"
    }
}
```

### 5. Payment Project

- URL: `/api/contractor/project/payment`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**
- Request body:
  - `project_id`: int
  - `photo_url`: file, max size 4MB
  - `amount`: integer
  - `description`: string (opsional)

**Example success response**
```json
{
    "success": true,
    "message": "success",
    "data": {
        "id": 3,
        "user_id": 31,
        "project_id": 9,
        "photo_url": "http://127.0.0.1:8000/storage/project/9/payment/166096909781.jpg",
        "amount": 1200000,
        "status": "waiting",
        "description": "Transfer 1200000 fee transport"
    }
}
```

**Example user does not have a contractor role response**
```json
{
    "success": false,
    "message": "1009:You are not authorized to create project",
    "data": {
        "message": "You are not authorized to create project",
        "code": 1009
    }
}
```

**Example if project is not yours response**
```json
{
    "success": false,
    "message": "1010:You are not authorized to payment this project",
    "data": {
        "message": "You are not authorized to payment this project",
        "code": 1010
    }
}
```

### 6. Complete project

- URL: `/api/contractor/project/complete`
- Method: `POST`
- Headers:
  - Authorization: Bearer **{token}**
- Request body:
  - `project_id`: int

**Example success response**
```json
{
    "success": true,
    "message": "success"
}
```

**Example if percentage is not 100% response**
```json
{
    "success": false,
    "message": "1021:Project percentage must be 100% to finish project",
    "data": {
        "message": "Project percentage must be 100% to finish project",
        "code": 1021
    }
}
```

**Example project does not have ongoing status response**
```json
{
    "success": false,
    "message": "1020:Project percentage must be 100% to finish project",
    "data": {
        "message": "Project percentage must be 100% to finish project",
        "code": 1020
    }
}
```

**Example if project is not yours response**
```json
{
    "success": false,
    "message": "1019:You are not authorized to complete this project",
    "data": {
        "message": "You are not authorized to complete this project",
        "code": 1019
    }
}
```
