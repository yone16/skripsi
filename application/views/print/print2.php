<!DOCTYPE html>
<html lang="">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>Invoice <?= $detail['transaksi_id'] ?> | Sahabat Laundry</title>
    <style>
        @media print {
            @page {
                margin: 0 auto;
                /* imprtant to logo margin */
                sheet-size: 300px 130mm;
                /* imprtant to set paper size */
            }

            html {
                direction: rtl;
            }

            html,
            body {
                margin: 0;
                padding: 0
            }

            #printContainer {
                width: 250px;
                margin: auto;
                /*padding: 10px;*/
                /*border: 2px dotted #000;*/
                text-align: justify;
            }

            .text-center {
                text-align: center;
            }
        }
    </style>
</head>

<body onload="window.print();">
    <div id='printContainer'>
        <br>
        <h2 id="slogan" class="text-center">Sahabat Laundry</h2>
        <p style="text-align: center;font-size: 10px;"><?= date("d-m-Y H:i:s", time()); ?></p>

        <table>
            <tr>
                <td style="font-size: 12px;">Invoice</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['transaksi_id']; ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Pelanggan</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['nama_pelanggan']; ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Tanggal Order</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['tgl_order']; ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Tanggal Selesai</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['tgl_selesai']; ?></b></td>
            </tr>
        </table>
        <hr>
        <p style="margin-top: -5px;"><b>Detail Pesanan Satuan</b></p>
        <table>
            <tr>
                <td style="font-size: 12px;">Tipe Order</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['jeniskg']; ?></b></td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Tipe Layanan</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['jenislyn']; ?> (<?= $detail['hargalyn'] ?>X)</b></td>
            </tr>
            <tr>
                <td style="font-size: 12px;">Item</td>
                <td style="font-size: 12px;">:</td>
                <td style="font-size: 12px;"><b><?= $detail['berat']; ?> Item</b></td>
            </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td style="font-size: 12px;"><b>Total Pembayaran</b></td>
                <td style="font-size: 12px;"><b>:</b></td>
                <td style="font-size: 12px;"><b>Rp.<?= number_format($detail['total'],0,',','.'); ?></b></td>
            </tr>
        </table>
        <hr>

        <div style="text-align: center; font-size: 12px">
            <span>**INVOICE LAUNDRY**</span>
        </div>

    </div>
</body>

</html>