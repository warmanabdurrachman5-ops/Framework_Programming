        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            margin: 0;
            padding: 40px 20px;
        }

        /* Container Card putih */
        .card-container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            padding: 30px 40px;
        }

        /* Judul Halaman */
        .page-title {
            color: #0c4d8b; /* Biru LP3I */
            font-weight: 700;
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 20px;
        }

        /* Navigasi Menu Atas */
        .nav-menu {
            display: flex;
            gap: 15px;
            border-bottom: 2px solid #f0f3f6;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        .nav-menu a {
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            font-size: 14px;
            padding: 8px 12px;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .nav-menu a:hover {
            background-color: #f0f4f8;
            color: #0c4d8b;
        }
        
        /* Menu yang sedang aktif */
        .nav-menu a.active {
            background-color: #e6f0fa;
            color: #0c4d8b;
        }

        /* Pesan Sukses */
        .success {
            color: #155724;
            background-color: #d4edda;
            padding: 12px 15px;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
            font-size: 14px;
        }

        /* Desain Tombol */
        .action-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .btn {
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13px;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-tambah { 
            background-color: #0c4d8b; 
            color: white; }

        .btn-tambah:hover { 
            background-color: #093967; }

        .btn-edit { 
            background-color: #f0f4f8; 
            color: #0c4d8b; 
            border: 1px solid #0c4d8b; }

        .btn-edit:hover { 
            background-color: #0c4d8b; 
            color: white; }

        .btn-hapus { 
            background-color: #db2d2d; 
            color: white; 
            margin-left: 5px; }

        .btn-hapus:hover { 
            background-color: #b52424; }

        /* Desain Tabel Modern */
        table { width: 100%; 
        border-collapse: collapse; }
        
        th, td {
            padding: 16px 15px;
            text-align: left;
            border-bottom: 1px solid #edf2f7;
        }

        th {
            background-color: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        td { font-size: 14px; color: #4a5568; vertical-align: middle; }
        tr:hover { background-color: #fcfcfc; }

        /* Badge untuk Jurusan & Angkatan */
        .badge {
            background-color: #e2e8f0;
            color: #334155;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
        .badge-blue { background-color: #e0f2fe; color: #0369a1; }

        /////////////////////////////////////////////////Style edit//////////////////////////////////////////////////////

        body {
    font-family: Arial, sans-serif;
    max-width: 1100px;
    margin: 30px auto;
    padding: 0 20px;
}

h1 {
    margin-bottom: 10px;
}

a {
    color: #155eeF;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th,
td {
    border: 1px solid #999;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.success {
    padding: 10px;
    background-color: #e8f7e8;
    color: #176b17;
}

form {
    display: inline;
}

label {
    display: inline-block;
    margin-bottom: 5px;
    font-weight: bold;
}

input,
select {
    width: 100%;
    box-sizing: border-box;
    padding: 9px;
}

input[type="checkbox"] {
    width: auto;
    padding: 0;
    margin-right: 6px;
}

button,
.btn {
    padding: 8px 14px;
    background-color: #f0f0f0;
    border: 1px solid #999;
    cursor: pointer;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #000;
    text-decoration: none;
    display: inline-block;
}

.errors {
    padding: 10px 10px 10px 30px;
    background-color: #ffecec;
    color: #a40000;
}

/* Navigasi utama */
.main-nav {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 0;
    border-bottom: 1px solid #ddd;
    margin-bottom: 16px;
}

.nav-links a {
    margin-right: 14px;
    text-decoration: none;
}

.nav-links a:hover {
    text-decoration: underline;
}

.nav-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-info {
    font-size: 14px;
    color: #333;
}

/* Pagination sederhana */
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 20px 0 0;
    gap: 6px;
    flex-wrap: wrap;
}

.pagination li span,
.pagination li a {
    display: inline-block;
    padding: 6px 16px;
    border: 1px solid #000000;
    text-decoration: none;
    color: #000;
    background-color: #f0f0f0;
}

.pagination li a:hover {
    background-color: #e0e0e0;
}

.pagination li.active span {
    background-color: #155eef;
    border-color: #155eef;
    color: #fff;
    font-weight: bold;
}

.pagination li.disabled span {
    color: #999;
    background-color: #f7f7f7;
    cursor: not-allowed;
}

////////////////////////////////////////

.foto-thumb{
    display: block;
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 4px;
}

.foto-preview{
   display: block;
    max-width: 120px;
    margin-bottom: 8px;
    padding: 3px;
    border 1px solid #999
}

.hint {
    display: block;
    margin-top: 4px;
    font-size: 12px;
    color: #666;
}