<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SIBARA | Informasi Barang Rampasan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<style>
      .container {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
      }
    
      .logo {
        width: 100px; /* Atur ukuran logo sesuai kebutuhan */
        height: auto; /* Atur ketinggian agar logo tidak terdistorsi */
        margin-right: 50px; /* Memberi jarak antara logo dan teks */
        margin-left: -50px;
      }
    
      .text-container {
        margin-left: 20px; /* Atur jarak antara logo dan teks */
      }

      hr {
        width: 100%; /* Atur lebar garis horizontal agar memenuhi lebar container */
        margin: 5px 0; /* Atur jarak atas dan bawah dari hr */
        border: none; /* Hapus border */
        border-top: 3px solid black; /* Tambahkan border atas dengan warna hitam */
      }

      @media print {
        /* Atur tata letak untuk saat dicetak */
        .container {
          flex-direction: column;
        }
    
        .text-container {
          margin-top: 10px; /* Atur jarak antara logo dan teks saat dicetak */
          margin-left: 0; /* Setel margin kembali ke 0 */
        }
      }
  </style>
</head>

<body>
    <div class="container">
			<a href="/"><img src="{{ asset('images/logo2.png') }}" alt="logo" class="logo"></a>
			<div class="text-container">
				<h5 style="font-weight: normal; margin-bottom: 1px">KEJAKSAAN REPUBLIK INDONESIA</h5>
				<h5 style="font-weight: normal; margin-bottom: 0px">KEJAKSAAN TINGGI BALI</h5>
				<h2 style="margin-bottom: 1px"><strong>KEJAKSAAN NEGERI DENPASAR</strong></h2>
				<p style="margin-bottom: 1px; font-size: 10pt;"> JALAN PB. SUDIRMAN NO. 3 DENPASAR BALI 80232</p>
				<p style="margin-bottom: 1px; font-size: 10pt;">Telp. (0361)-221999, Fax: (0361)-236954. <u>www.kejari-denpasar.go.id</u></p>
			</div>
		</div>

  <hr>

	<br><br><br>
	<p class="text-center"><strong>Informasi Barang Rampasan Negara</strong></p>
	<p class="text-center"><strong>Scan QR Code dibawah ini</strong></p>
	<br><br><br><br>
	<p class="text-center"><img src="data:image/svg;base64,{{ base64_encode($qrCode) }}" alt="QR Code"></p>

</body>

</html>

