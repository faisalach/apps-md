<div style="width:21cm;position: relative;">
    <img src="/assets/template_sertifikat.jpg" alt="" style="width: 100%">
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
    top: 18.8cm;
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