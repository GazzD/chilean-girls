<html>
<body>
<table width="600" cellspacing="0" cellpadding="0" bgcolor="#fff" align="center">
		<thead>
			<tr>
				<div align="center">
					<img style="margin-left:auto; margin-right:auto" src="{{asset('frontend/images/Logo-MedProzone-M.png')}}" alt="Medprozone">
				</div>
				<th style="background-color: #FFFFFF; padding: 25px 0 0 0; border-bottom: 5px solid #FF0000" />
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style= "padding: 50px 80px; font-family: Arial, Helvetica, sans-serif; color: #000000;">
					<h2 style="font-style: italic">Hello {{ $adminUser->firstName }}</h2>
					
					<p style="font-size: 12px; margin: 10px 0 50px 0;">
						Welcome
						<br/><br/>
						{{ $notificationMessage }}
						<br/><br/>
						You can log on to the following <a href="{{route('sign-in')}}">Link</a>
					</p>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td style="background-color: #FFFFFF; height: 25px; border-bottom: 5px solid #FF0000; font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #666666; text-align: center;">
				<span><b>&copy; 2016 The next medical shop - All rights reserved</b></span>
				</td>
			</tr>
		</tfoot>
	</table>
</body>
</html>

             