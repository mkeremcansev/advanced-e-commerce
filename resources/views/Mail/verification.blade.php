<table style="border-collapse:collapse;background:white;border-radius:5px;margin-bottom:16px" cellspacing="0" cellpadding="32" border="0" align="center">
				<tbody>
				<tr>
					<td style="font-family:’Helvetica Neue’,Helvetica,Arial,sans-serif!important;border-collapse:collapse" width="546" valign="top">
						<div style="max-width:600px;margin:0 auto">
							<div style="background:white;border-radius:8px;margin-bottom:8px">
								<h2 style="color:#e34930;line-height:30px;margin-bottom:12px;margin:0 0 12px"><span style="color:#424243">@lang('words.hello')</span></h2>
								<p style="font-size:17px;line-height:24px;margin:0 0 16px">
									{{ $settings->title }} @lang('words.verify-desc')
								</p>
								<table style="border-collapse:collapse;width:100%">
									<tbody>
									<tr style="width:100%">
										<td style="font-family:’Helvetica Neue’,Helvetica,Arial,sans-serif!important;border-collapse:collapse;width:100%;text-align:center;padding:16px 0 16px">
                                          <span style="display:inline-block;border-radius:4px;background:#1f8b5f;border-bottom:2px solid #e34930">
                                          <a href="{{ route('Web.Account.verification', $verification) }}" style="color:white;font-weight:normal;text-decoration:none;word-break:break-word;font-size:20px;line-height:26px;border-top:14px solid;border-bottom:14px solid;border-right:32px solid;border-left:32px solid;background-color:#e34930;border-color:#e34930;display:inline-block;letter-spacing:1px;min-width:80px;text-align:center;border-radius:4px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.bynogame.com/aktiflestir?s%3DA315B415913910661540637%26t%3Dfde39e66d454525f90bd383872fe8044fca0a901df0d36a78b86a2c204c9a7b7&amp;source=gmail&amp;ust=1624541322167000&amp;usg=AFQjCNH9CTIenVS_6U-Z_lS4cXmPPCRqhQ">
                                          @lang('words.verification-button')
                                          </a>
                                          </span>
										</td>
									</tr>
									</tbody>
								</table>
								<p style="font-size:17px;line-height:24px;margin:0 0 16px">
									@lang('words.verify-warn') <a href="mailto:{{ $settings->mail }}" style="color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word" target="_blank">{{ $settings->mail }}</a> @lang('words.verify-warn-to')
								</p>
							</div>
						</div>
					</td>
				</tr>
				</tbody>
			</table>