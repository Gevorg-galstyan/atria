<table width="100%" cellpadding="0" cellspacing="0"
       style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;background-color: rgba(189, 155, 140, 0.9);margin: 0;padding: 0;width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;-premailer-width: 100%;">
    <tbody>
    <tr>
        <td align="center" style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;">
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;margin: 0;padding: 0;width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;-premailer-width: 100%;">
                <tbody>
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;padding: 25px 0;text-align: center;">
                        <a href="http://localhost"
                           style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;color: white;font-size: 19px;font-weight: bold;text-decoration: none;text-shadow: 0 1px 0 white;"
                           target="_blank" rel="noopener">
                            Hello!
                        </a>
                    </td>
                </tr>
                <tr>
                    <td width="100%" cellpadding="0" cellspacing="0"
                        style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;background-color: #FFFFFF;border-bottom: 1px solid #EDEFF2;border-top: 1px solid #EDEFF2;margin: 0;padding: 0;width: 100%;-premailer-cellpadding: 0;-premailer-cellspacing: 0;-premailer-width: 100%;">
                        <table align="center" width="570" cellpadding="0" cellspacing="0"
                               style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;background-color: #FFFFFF;margin: 0 auto;padding: 0;width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0;-premailer-width: 570px;">
                            <tbody>
                            <tr>
                                <td style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;padding: 35px;">

                                    <p style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;color: #74787E;font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                        @if($name)
                                            <b>{{$name}} </b>
                                            want to ask some questions.
                                        @endif
                                    </p>

                                    <p style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;color: rgba(189, 155, 140, 0.9);font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;">

                                        @if($name)
                                            <b>Subject:</b>
                                            {{$subject}}
                                        @endif
                                    </p></br>
                                    <p style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;color: rgba(189, 155, 140, 0.9);font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;">
                                        <b>Text:</b>
                                        {{$text}}
                                    </p>
                                    <hr>

                                    <br>
                                    <b>User Email:</b>
                                    {{$email}}

                                    <br>
                                    @if($number)
                                        <b>User Phone:</b>
                                        {{$number}}
                                        @endif
                                        </p>
                                        {{--<p style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;color: #74787E;font-size: 16px;line-height: 1.5em;margin-top: 0;text-align: left;">--}}

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;">
                        <table align="center" width="570" cellpadding="0" cellspacing="0"
                               style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;margin: 0 auto;padding: 0;text-align: center;width: 570px;-premailer-cellpadding: 0;-premailer-cellspacing: 0;-premailer-width: 570px;">
                            <tbody>
                            <tr>
                                <td align="center"
                                    style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;padding: 35px;">
                                    <p style="font-family: Avenir, Helvetica, sans-serif;box-sizing: border-box;line-height: 1.5em;margin-top: 0;color: white;font-size: 12px;text-align: center;">
                                        © 2017 All rights reserved.</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>