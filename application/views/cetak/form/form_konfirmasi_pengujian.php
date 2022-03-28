<?php 

$mpdf = new \Mpdf\Mpdf(['format' => [215, 330] ]);
$mpdf->SetHTMLHeader('<div class="header"><b>'.$judul.'</b></div>') ;

// header
    $html =$header ;
// header

// body 
    $html .= '

        <div class="isi" >
            <table cellpadding=3 cellspacing=3 >
                <tr>
                    <td valign="top">1</td>
                    <td valign="top" >Nama Pelanggan</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=6></td>
                </tr>
                <tr>
                    <td valign="top">2</td>
                    <td valign="top">Nomor & Tanggal Surat</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=5></td>
                </tr>
                <tr>
                    <td valign="top">3</td>
                    <td valign="top">Alamat</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=5></td>
                </tr>
                <tr>
                    <td valign="top">4</td>
                    <td valign="top">Alamat E-mail</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=5></td>
                </tr>
                <tr>
                    <td valign="top">5</td>
                    <td valign="top">No. Telpon/HP</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=5></td>
                </tr>
                <tr>
                    <td valign="top">6</td>
                    <td valign="top">Tanggal Kunjungan</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=5></td>
                </tr>
                <tr>
                    <td valign="top">6</td>
                    <td valign="top">Tanggal Kunjungan</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=5></td>
                </tr>
                <tr>
                    <td valign="top">7</td>
                    <td valign="top">Jenis contoh yang diuji</td>
                    <td valign="top">:</td>
                    <td valign="top"><input type="checkbox"> <label> Vaksin </label></td>
                    <td valign="top"><input type="checkbox"> <label> Bulk </label></td>
                    <td valign="top"><input type="checkbox"> <label> PKRT </label> </td>
                    <td valign="top"><input type="checkbox"> <label> Preparat </label></td>
                    <td valign="top"><input type="checkbox"> <label> Alat Kesehatan (ALKES) </label></td>
                </tr>
                <tr>
                    <td valign="top">8</td>
                    <td valign="top">Jenis Pengujian</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=2>
                        <input type="checkbox"> <label> Parameter Uji </label> 
                    </td>
                    <td valign="top" colspan=2>
                        <input type="checkbox"> <label> Pengujian Vaksin </label> 
                    </td>
                    <td valign="top" colspan=2>
                        <input type="checkbox"> <label> Pengujian Balai </label> 
                    </td>
                </tr>
                <tr>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top"></td>
                    <td valign="top" colspan=2>
                        <input type="checkbox"> <label> Pembacaan Preparat </label> 
                    </td>
                    <td valign="top" colspan=2>
                        <input type="checkbox"> <label> Pengujian pBal </label> 
                    </td>
                </tr>
                <tr>
                    <td valign="top">9</td>
                    <td valign="top">Hal yg dikonfirmasi ke <br> laboratorium</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=2>
                        <div> <input type="checkbox"> <label> Parameter uji </label> </div> 
                        <div> <input type="checkbox"> <label> Biaya pengujian </label> </div> 
                        <div> <input type="checkbox"> <label> Jumlah sample </label> </div> 
                        <div> <input type="checkbox"> <label> Ketersediaan metode </label> </div> 
                        <div> <input type="checkbox"> <label> Ketersediaan BBP </label> </div> 
                        <div> <input type="checkbox"> <label> Ketersediaan alat dan instrumen </label> </div> 
                        <div> <input type="checkbox"> <label> Ketersediaan reagen dan <br> media Hewan Uji </label> </div> 
                    </td>
                    <td valign="top" colspan=2>
                        <div> <input type="checkbox"> <label> Sesuai </label> </div> 
                        <div> <input type="checkbox"> <label> Sesuai </label> </div> 
                        <div> <input type="checkbox"> <label> Sesuai </label> </div> 
                        <div> <input type="checkbox"> <label> Tersedia </label> </div> 
                        <div> <input type="checkbox"> <label> Tersedia </label> </div> 
                        <div> <input type="checkbox"> <label> Tersedia </label> </div>
                        <div> <input type="checkbox"> <label> Tersedia </label> </div> 
                    </td>
                    <td valign="top" colspan=2>
                        <div> <input type="checkbox"> <label> Belum Sesuai </label> </div> 
                        <div> <input type="checkbox"> <label> Belum Sesuai </label> </div> 
                        <div> <input type="checkbox"> <label> Belum Sesuai </label> </div> 
                        <div> <input type="checkbox"> <label> Tdk Tersedia </label> </div> 
                        <div> <input type="checkbox"> <label> Tdk Tersedia </label> </div> 
                        <div> <input type="checkbox"> <label> Tdk Tersedia </label> </div>
                        <div> <input type="checkbox"> <label> Tdk Tersedia </label> </div> 
                    </td>
                </tr>
                <tr>
                    <td valign="top">10</td>
                    <td valign="top">Laboratorium Terkait</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=2>
                        <div> <input type="checkbox"> <label> Produk Biologi </label> </div> 
                    </td>
                </tr>
                <tr>
                    <td valign="top">11</td>
                    <td valign="top">Konfirmasi dilakukan dengan cara</td>
                    <td valign="top">:</td>
                    <td valign="top" colspan=2>
                        <input type="checkbox"> <label> Datang Langsung </label>  
                    </td>
                    <td valign="top" colspan=4>
                        <input type="checkbox"> <label> Melalui telpon / WA / Email </label>  
                    </td>
                </tr>
                <tr>
                    <td valign="top">12</td>
                    <td valign="top">*Kesimpulan Hasil Konfirmasi</td>
                </tr>
                <tr>
                    <td valign="top" colspan=9 height=200px class="_12"></td>
                </tr>
            </table>
        </div>
    ' ;
// body 

// footer
    $html .= '</body></html>' ;
// footer

$mpdf->SetHTMLFooter('<div class="footer">F/xxx/0000</div> <div class="footer-kanan">{PAGENO}</div>') ;
$mpdf->WriteHTML($html);

$mpdf->Output('Evaluasi Dokumen Produksi Vaksin .pdf' ,'I');

// $mpdf->Output();
// echo $html ;


?>

