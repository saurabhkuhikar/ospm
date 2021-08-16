<!--
@params
link = email verification url (required)
username = username  (optional) 
-->
<div>
    <table border="0" cellspacing="0" cellpadding="0" style="max-width:600px;min-width:318px;font-family:Arial;font-size:13px;color:#000000" align="center" bgcolor="#e3e2e2">
        <tbody>            
            <tr>
                <td> </td>
                <td>
                    <img src="https://www.luxottica.com/sites/luxottica.com/files/styles/brand_breakpoints_theme_luxottica13rwd_thr1366_1x/public/brand/mainimage/opsm_4_0.jpg?timestamp=1606909159" width="193" height="50" vspace="10" hspace="0" align="left" border="0" alt="abc.com" class="CToWUd">
                    <table border="0" cellpadding="0" cellspacing="0" align="right" width="240"><tbody><tr><td width="184" height="64" style="font-family:Arial;font-size:12px;color:#474646">
                                    <img src="https://mpng.subpng.com/20190622/kuu/kisspng-font-awesome-computer-icons-scalable-vector-graphi-buckle-square-high-heels-lace-up-ankle-lady-fashio-5d0ecfc6caf299.5041264315612517828313.jpg" width="24" height="24" vspace="0" hspace="0" align="absmiddle" class="CToWUd">
                                    <font style="font-size:13px" color="#474646">
                                    <strong>Call us at:</strong>
                                    </font>  (Toll free)
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
            </tr>
            <tr><td width="14"></td>
                <td bgcolor="#ffffff" valign="top" width="572">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5" style="font-family:Arial;font-size:13px;color:#000000">
                        <tbody>
                            <tr>
                                <td height="117" colspan="3" background="" bgcolor="#FFFBCA" style="padding-left:16px">
                                    <img src="https://d29fhpw069ctt2.cloudfront.net/icon/image/38198/preview.svg" vspace="0" hspace="0" align="left" width="92" class="CToWUd">
                                    <table width="80%" border="0" cellspacing="0" cellpadding="0" align="left" style="font-family:Times New Roman;font-size:19px;color:#000000">
                                        <tbody>
                                            <tr>
                                                <td style="padding: 10px;">
                                                    <font style="font-size:36px">Verify Email Address</font><br>
                                                    <?php echo $userDetails['first_name']; ?>                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr><td colspan="3" height="17"></td></tr>
                            <tr>
                                <td></td>
                                <td>Dear <?= isset($userDetails['first_name']) ? $userDetails['first_name'] : 'Member' ?> </td>
                                <td></td>
                            </tr>
                            <tr><td colspan="3" height="20"></td></tr>
                            <tr><td></td>
                                <td>Welcome to OSPM.com </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td height="50">Please verify your email account. </td>
                                <td></td>
                            </tr>
                            <tr>
                            <td colspan="3">
                                <div >
                                    <p>User Id : <?= $userDetails['user_id'] ?></p>
                                     <p>Password : <?= $userDetails['password'] ?></p>
                                </div>
                                <a href="http://localhost:8080/supplier/download?fileName=Y3lsaW5kZXJTdGF0dXNMaXN0czEucGRm" target="_blank" rel="noopener noreferrer"> Click to download</a>
                            </td>
                            </tr>                            
                            <tr>
                                <td colspan="3" height="30"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <table width="264" border="0" cellspacing="0" cellpadding="0" style="font-family:Arial;font-size:13px;color:#000000">
                                        <tbody>
                                            <tr>
                                                <td width="116" height="39" background="" bgcolor="#C4161C" align="center">
                                                    <strong>
                                                        <!--// click to start bidding --> 
                                                        <a style="text-decoration:none;color:#ffffff;display:block;line-height:39px" href="<?= isset($link) ? $link :''?>" target="_blank">Click here &nbsp; &nbsp;</a>
                                                    </strong>
                                                </td>
                                                <td align="right">to verify your email account.</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td height="11" style="border-bottom:1px dashed #d4d4d4;display:block"></td>
                                <td></td>
                            </tr>
                            <tr><td></td>
                                <td height="31" style="font-size:12px;color:#474646">In case of a query, call us at: <strong></strong> or email us at : <a href="mailto:mail@abc.com" style="color:#0f529d" target="_blank">mail@abc.com</a></td>
                                <td></td>
                            </tr>
                            <tr><td></td>
                                <td height="35" style="border-top:1px dashed #d4d4d4;display:block"></td>
                                <td></td>
                            </tr>                            
                            <tr><td></td>
                                <td></td>
                            </tr>
                            <tr><td height="10"></td>
                            </tr>
                            <tr><td colspan="3" height="12"></td>
                            </tr>

                            <tr bgcolor="#e3e2e2"><td></td>
                                <td>
                                    <table style="font-family:Arial" border="0" cellpadding="0" cellspacing="0" width="100%"><tbody>

                                            <tr>
                                                <td>
                                                    <table style="font-family:Arial,Times New Roman,Times,serif;font-size:11px;line-height:17px;color:#000000;margin-left:10px" align="left" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-size:12px;padding: 10px;" valign="top">Warm Regards,<br><b style="color:#c4161c">abc<span style="font-size:1px"> </span><font color="#00000">.com Team</font></b><br>
                                                                    <a href="http://www.facebook.com/abc" target="_blank"><img src="http://abc.com/images/social/facebook.gif" width="111" height="36" border="0" alt="Join Us on Facebook" vspace="4" class="CToWUd"></a>
                                                                </td>
                                                                <td style="font-size:12px" valign="top" width="10">&nbsp;</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table style="font-family:Arial,Times New Roman,Times,serif;font-size:11px;line-height:17px;color:#000000" border="0" cellpadding="0" cellspacing="0" align="right">
                                                        <tbody>
                                                            <tr>
                                                                <td valign="top" style="padding-top: 10px;">
                                                                    <img src="http://abc.com/images/call.png" align="absmiddle" height="24" width="24" class="CToWUd">
                                                                </td>
                                                                <td style="font-family:Arial;font-size:12px;padding-top: 10px;" width="226" align="left">
                                                                    <span style="font-size:13px"><b>Call us at:</b></span> , or
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td valign="top" style="padding-top: 5px;">
                                                                <img src="https://i.pinimg.com/564x/ad/4a/67/ad4a67a25bc3732713de694a782d441b.jpg" align="absmiddle" height="36" width="31" class="CToWUd"></td>
                                                                <td style="font-family:Arial;font-size:12px;padding-top: 5px;" align="left">
                                                                    Address <strong>abc.com:</strong><br>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>                        
                </td>
                <td width="14"></td>
            </tr>
            <tr bgcolor="#e3e2e2">
                <td colspan="3" height="22"></td>
            </tr>
            <tr bgcolor="#e3e2e2">
                <td></td>
                <td style="font-size:11px;color:#a3a3a3" align="center" height="46">You are receiving this mail as a registered member of abc.com.<br>In case you do not wish to receive mails from abc.com in the future, you can <a style="text-decoration:underline;color:#0f529d" href="#" target="_blank">unsubscribe.</a></td>
                <td></td>
            </tr>
            <tr>
                <td width="14"></td>
            </tr>
        </tbody>
    </table>
</div>