<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pendaftaran ISE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
       function validasi() {
    var nrp = document.getElementById("nrp").value.trim();
    var nama = document.getElementById("nama").value.trim();

    // Cek NRP tidak boleh kosong
    if (nrp.length === 0) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "NRP tidak boleh kosong!",
            icon: "error"
        });
        return false;
    }

    // Cek NRP harus angka
    if (!/^\d+$/.test(nrp)) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "NRP harus berupa angka saja!",
            icon: "error"
        });
        return false;
    }

    // Cek NRP harus 10 digit
    if (nrp.length !== 10) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "NRP harus terdiri dari 10 digit angka!",
            icon: "error"
        });
        return false;
    }

    // Cek Nama tidak boleh kosong
    if (nama.length === 0) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "Nama tidak boleh kosong!",
            icon: "error"
        });
        return false;
    }

    // Cek Nama tidak boleh angka
    if (!isNaN(nama)) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "Nama tidak boleh berupa angka!",
            icon: "error"
        });
        return false;
    }

    // Cek Nama tidak boleh mengandung angka
    if (/\d/.test(nama)) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "Nama tidak boleh mengandung angka!",
            icon: "error"
        });
        return false;
    }

    // Cek Nama minimal 2 huruf
    if (nama.length < 2) {
        Swal.fire({
            title: "Kesalahan Input",
            text: "Nama harus terdiri dari minimal 2 huruf!",
            icon: "error"
        });
        return false;
    }

    return true;
}

    </script>
</head>
<body>
    <div class="container">
        <form action="https://google.co.id" method="get" onsubmit="return validasi();">
            <h3>Form Pendaftaran</h3>
            NRP : <input type="text" name="nrp" id="nrp" class="form-control" placeholder="Silahkan diisi 10 digit NRP">
            <br>
            Nama : <input type="text" name="nama" id="nama" class="form-control" placeholder="Isikan nama peserta yang valid">
            <br>
            <input type="submit" class="btn btn-success" value="Daftar">
        </form>
    </div>
</body>
</html>
