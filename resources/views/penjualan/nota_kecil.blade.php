<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota Kecil</title>

    <?php
    $style = '
    <style>
        * {
            font-family: "consolas", sans-serif;
        }
        p {
            display: block;
            margin: 0px;
            font-size: 10pt;
        }
        table td {
            font-size: 9pt;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }

        @media print {
            @page {
                margin: 0;
                size: 75mm 
    ';
    ?>
    <?php 
    $style .= 
        ! empty($_COOKIE['innerHeight'])
            ? $_COOKIE['innerHeight'] .'mm; }'
            : '}';
    ?>
    <?php
    $style .= '
            html, body {
                width: 70mm;
            }
            .btn-print {
                display: none;
            }
        }
    </style>
    ';
    ?>

    {!! $style !!}
</head>
<body onload="window.print()">
    <button class="btn-print" style="position: fixed; right: 1rem; top: rem;" onclick="window.print()">Print</button>
    <div class="text-center">
        @if (!empty($setting->path_logo))
            <img src="{{ url('/') }}/{{ $setting->path_logo }}" alt="Logo" style="max-height:150px; margin-bottom:-50px;">
        @endif
        <h4>{{ strtoupper($setting->nama_perusahaan) }}</h4>
        <h6 style="margin-top: -20px;">{{ strtoupper($setting->alamat) }}</h6>
        <h6 style="margin-top: -30px;" class="text-center">=============================================</h6>
    </div>
    <table style="margin-top: -30px;">
        <tr>
            <td> No: {{ tambah_nol_didepan($penjualan->id_penjualan, 5) }}</td>
            <td>Tanggal: {{ date('d-m-Y H:i:s') }}</td>
        </tr>
        <tr>
            <td colspan="2">Kasir: {{ auth()->user()->name }}</td>
        </tr>
        <tr>
            <td colspan="2" class="text-center">---------------------------------------</td>
        </tr>
    </table>
    <table width="100%" style="border: 0; margin-top: -12px; padding-right: 10px;">
        @foreach ($detail as $item)
            <tr>
                <td colspan="2">{{ $item->produk->nama_produk }}</td>
            </tr>
            <tr>
                <td>{{ $item->jumlah }} x {{ format_uang($item->harga_jual) }}</td>
                <td class="text-right">{{ format_uang($item->jumlah * $item->harga_jual) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" class="text-center">-------------------------------------</td>
        </tr>
</table>
    <table width="100%" style="border: 0; margin-top: -10px; padding-right: 10px;">
        <tr style="margin-top: -10px;">
            <td>Total Harga:</td>
            <td class="text-right">{{ format_uang($penjualan->total_harga) }}</td>
        </tr>
        <tr style="margin-top: -10px;">
            <td>Total Item:</td>
            <td class="text-right">{{ format_uang($penjualan->total_item) }}</td>
        </tr>
        <tr style="margin-top: -10px;">
            <td>Diskon:</td>
            <td class="text-right">{{ format_uang($penjualan->diskon) }}</td>
        </tr>
        <tr style="margin-top: -10px;">
            <td>Total Bayar:</td>
            <td class="text-right">{{ format_uang($penjualan->bayar) }}</td>
        </tr>
        <tr style="margin-top: -10px;">
            <td>Diterima:</td>
            <td class="text-right">{{ format_uang($penjualan->diterima) }}</td>
        </tr>
        <tr style="margin-top: -10px;">
            <td>Kembali:</td>
            <td class="text-right">{{ format_uang($penjualan->diterima - $penjualan->bayar) }}</td>
        </tr>
    </table>

    <p class="text-center">===================================</p>
    <p class="text-center">Telp.{{ strtoupper($setting->telepon) }}</p>
    <p class="text-center">--Terimakasih--</p>

    <script>
        let body = document.body;
        let html = document.documentElement;
        let height = Math.max(
                body.scrollHeight, body.offsetHeight,
                html.clientHeight, html.scrollHeight, html.offsetHeight
            );

        document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        document.cookie = "innerHeight="+ ((height + 50) * 0.264583);
    </script>
</body>
</html>