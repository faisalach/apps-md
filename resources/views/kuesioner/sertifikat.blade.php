<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page { margin: 0px; }
        body { margin: 0px; }
    </style>
</head>
<body style="padding: 0px;margin:0px">
    <div style="width:20.99cm;position: relative;">
        <img src="data:image/jpeg;base64, {{ $image }}" alt="" style="width: 100%;">
        <p style="position: absolute;
        left: 6.5cm;
        right: 1cm;
        top: 10.75cm;
        text-align: center;
        font-size: 30px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: bold;">{{ $kuesioner->nama_lengkap }}</p>
        <p style="position: absolute;
        left: 6cm;
        right: 1cm;
        top: 13cm;
        text-align: center;
        font-size: 38px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: bold;">{{ $value_number_tgl_lahir }}</p>
        <p style="position: absolute;
        left: 6.5cm;
        right: 1cm;
        top: 15.7cm;
        text-align: center;
        font-size: 38px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: bold;">{{ $kuesioner->golongan_darah }}</p>
        <p style="position: absolute;
        left: 6.5cm;
        right: 1cm;
        top: 18.9cm;
        text-align: center;
        font-size: 22px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: bold;">
            Visual : {{ round($kuesioner->persentase_visual) }}%
            Auditory : {{ round($kuesioner->persentase_auditory) }}%
            Kinestetik : {{ round($kuesioner->persentase_kinestetik) }}%
        </p>
        <p style="position: absolute;
        left: 6.5cm;
        right: 1cm;
        top: 21cm;
        text-align: center;
        font-size: 28px;
        font-family:Arial, Helvetica, sans-serif;
        font-weight: bold;">
            {{ $kuesioner->no_peserta }}
        </p>
    </div>
    {{-- <embed style="width: 20.99cm;height:100%" 
    type="application/pdf"
    frameBorder="0"
    src="data:application/pdf;base64, {{ $pdf_hasil_tes }}#toolbar=0&navpanes=0&scrollbar=0"> --}}
</body>