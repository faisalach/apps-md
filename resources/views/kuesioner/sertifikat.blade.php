<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body style="padding: 0px;margin:0px">
    <div style="width:21cm;position: relative;">
        <img src="data:image/jpeg;base64, {{ $image }}" alt="" style="width: 100%;">
        <p style="position: absolute;
        left: 3.8cm;
        right: 0px;
        top: 11.85cm;
        text-align: center;
        font-size: 30px;
        font-weight: bold;">{{ $kuesioner->nama_lengkap }}</p>
        <p style="position: absolute;
        left: 3.8cm;
        right: 0px;
        top: 13.7cm;
        text-align: center;
        font-size: 38px;
        font-weight: bold;">{{ $value_number_tgl_lahir }}</p>
        <p style="position: absolute;
        left: 3.8cm;
        right: 0px;
        top: 16.7cm;
        text-align: center;
        font-size: 38px;
        font-weight: bold;">{{ $kuesioner->golongan_darah }}</p>
        <p style="position: absolute;
        left: 3.8cm;
        right: 0px;
        top: 18.9cm;
        text-align: center;
        font-size: 22px;
        font-weight: bold;">
            Visual : {{ round($presentase_jawaban["visual"]) }}%
            Auditory : {{ round($presentase_jawaban["auditory"]) }}%
            Kinestetik : {{ round($presentase_jawaban["kinestetik"]) }}%
        </p>
        <p style="position: absolute;
        left: 3.8cm;
        right: 0px;
        top: 20cm;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        text-decoration: underline;">
            Nomor : {{ $kuesioner->no_peserta }}
        </p>
    </div>
</body>