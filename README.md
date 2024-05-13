# Project học phần Công nghệ Web (CT275)

Học kỳ 2, Năm học 2023-2024

**MSSV 1** : B2111838

**Họ tên SV 1**: Nguyễn Anh Hào

**Lớp học phần**: CT27501

**Tên dự án**: Website Quản Lý cửa hàng thú cưng

**Tài khoản vào trang quản lý**: username: admin@gmail.com | password: 123

**Cấu hình v-host**:(thư mục gốc trực tiếp trong ổ D)

        <VirtualHost *:80>	
        DocumentRoot "C:/xampp/htdocs" 
        ServerName localhost
        </VirtualHost>
        <VirtualHost *:80>	
            DocumentRoot "D:/Ani-site/public" 
            ServerName aniha-store.localhost
            #Set access permission 
            <Directory "D:/Ani-site/public"> 
                Options Indexes FollowSymLinks Includes ExecCGI
                AllowOverride All
                Require all granted

                RewriteEngine On
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteCond %{REQUEST_FILENAME} !-d
                RewriteRule . index.php [L]
            </Directory>
        </VirtualHost>
