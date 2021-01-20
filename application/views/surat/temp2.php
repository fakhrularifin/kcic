$.ajax({
					type: 'POST',
					url: baseURL+'api/getSuratDetail',
					data: {
						token: TOKEN,
						idSurat:surat.id,
					},
					dataType: 'json',
					success: function (response){ 
						console.log(response);
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						if(surat.pemeriksa === MAIL){
							console.log('surat :: ', surat);
							if(surat.statusDisetujui === 'NOT APPROVED'){
								$('#modalDetailSurat #action').html(`
									<button class="btn btn-success btnSetujuiSurat" data-id="${surat.id}"><i class="fa fa-check"></i> Setujui</button>
									<button class="btn btn-warning" id="btnBuatNotaRevisi" data-penerima="${surat.pengirim}" data-id="${surat.id}"><i class="fa fa-edit"></i> Buat Nota Revisi</button>
								`);
							}
						}

						$('#modalDetailSurat #detailSurat').html(`
							dari : ${response.data.pengirim} <br/>
							kepada : ${response.data.penerima} <br/>
							cc : ${response.data.penerimaCc === null ? '' : response.data.penerimaCc} <br/><br/>

							${response.data.memo}
						`);	
					},
					error: function (error) {
						Swal.fire({
							title: 'Ambil Data Detail Surat Gagal',
							text: error.responseText,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}
				})