
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage Teknisi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid black;
            font-weight: bold;
        }
        .jumbotron h1 {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
        }
        .card img {
            max-height: 100px;
            object-fit: contain;
        }
        .status-available { color: green; }
        .status-borrowed { color: red; }
        .badge-custom { background-color: #1e90ff; color: #fff; border-radius: 8px; padding: 2px 5px; }
        h5 { font-size: 0.9rem; }
        .section-title {
            text-align: center;
            font-size: 1rem;
            font-weight: bold;
            margin: 20px 0 10px;
            color: #555;
        }
        button { width: 100%; padding: 10px; font-weight: bold; }
    </style>
</head>

<body>
    <div class="container mt-3">
        <img src="images/LogoCekDong1.png" class="logo" alt="Logo">
        <div class="jumbotron">
            <h1 class="display-3">HomePage Teknisi</h1>
        </div>

        <div class="section-title">ALAT YANG SEDANG DISEWA</div>
        <div class="row g-2">
            <div class="col-6 col-md-3">
                <div class="card">
                    <img src="https://th.bing.com/th/id/OIP.u_eu0r4DitTmj8eYozxSJwHaEJ?w=300&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="SONY Cinema Line">
                    <h5>SONY Cinema Line</h5>
                    <span>
                        <i class="bi bi-x-circle-fill text-danger me-1"></i><span class="text-body">Dipinjam, kembali pada 10/12/24</span>
                    </span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <img src="https://th.bing.com/th/id/OIP.jp-G1BVwe73XpxytQ3m4CgHaHa?w=195&h=195&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="SONY NP-FZ100">
                    <h5>SONY NP-FZ100</h5>
                    <span>
                        <i class="bi bi-x-circle-fill text-danger me-1"></i><span class="text-body">Dipinjam, kembali pada 10/12/24</span>
                    </span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <img src="https://th.bing.com/th/id/OIP.QFXkICCp6z5XoJ65qnBLTgHaHa?w=204&h=204&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="SONY FE 24-70mm">
                    <h5>SONY FE 24-70mm</h5>
                    <span>
                        <i class="bi bi-x-circle-fill text-danger me-1"></i><span class="text-body">Dipinjam, kembali pada 10/12/24</span>
                    </span>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card">
                    <img src="https://th.bing.com/th?q=Sony+Camera+Front+View&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=en-ID&cc=ID&setlang=en&adlt=strict&t=1&mw=247" alt="Sony Maximum">
                    <h5>Sony Maximum</h5>
                    <span>
                        <i class="bi bi-x-circle-fill text-danger me-1"></i><span class="text-body">Dipinjam, kembali pada 10/12/24</span>
                    </span>
                </div>
            </div>
        </div>

        <button class="btn btn-secondary my-3">Cek Alat</button>

        <div class="section-title">MENUNGGU PERSETUJUAN</div>
        <div class="row g-2">
            <div class="col-6 col-md-3"><div class="card"><img src="https://th.bing.com/th/id/OIP.ZwZpEsYNbVaHaRR6b2ObZwHaGS?w=204&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Nikon D7500"><h5>Nikon D7500</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span>
            </div></div>

            <div class="col-6 col-md-3"><div class="card"><img src="https://th.bing.com/th/id/OIP.KdZNAOVjc4aSvWC6-o_tNAHaHa?w=176&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Canon Lens EFS 18-135mm"><h5>Canon Lens EFS 18-135mm</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span> </div></div>
            <div class="col-6 col-md-3"><div class="card"><img src="https://th.bing.com/th/id/OIP.3pE5Eo4gFzr3e0D2BkM7mwHaHa?w=173&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Sony PXW-290T"><h5>Sony PXW-290T</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span></div></div>
            <div class="col-6 col-md-3"><div class="card"><img src="images/camCanon.png" alt="Canon EOS 4000D"><h5>Canon EOS 4000D</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span></div></div>
            <div class="col-6 col-md-3"><div class="card"><img src="https://th.bing.com/th/id/OIP.hmSF9py3mg-JonIZUuxxBwHaHa?w=173&h=180&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Instax mini11"><h5>Instax mini11</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span></div></div>
            <div class="col-6 col-md-3"><div class="card"><img src="https://www.instax.com.au/wp-content/uploads/sites/3/2022/10/compare-mini-11-pastel-green.jpg" alt="Instax slim-go"><h5>Instax slim-go</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span></div></div>
            <div class="col-6 col-md-3"><div class="card"><img src="https://th.bing.com/th/id/OIP.Ls1TR9V-nTil5lZwZRB7fwHaHa?w=200&h=200&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Canon EOS 80D"><h5>Canon EOS 80D</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span></div></div>
            <div class="col-6 col-md-3"><div class="card"><img src="https://th.bing.com/th/id/OIP.Hy0V__K1PWJzW7aJM8VmbAHaFW?w=257&h=186&c=7&r=0&o=5&dpr=1.3&pid=1.7" alt="Sony Zeiss"><h5>Sony Zeiss</h5>
                <span>
                    <i class="bi bi-check-circle-fill text-success me-1"></i><span class="text-body">Disetujui pada 2/12/24</span>
                </span></div></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
