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

						$('#modalDetailSurat #detailSurat').html(`
							dari : ${response.data.pengirim} <br/>
							kepada : ${response.data.penerima} <br/>
							cc : ${response.data.penerimaCc === null ? '' : response.data.penerimaCc} <br/><br/>

							${response.data.memo}
						`);

						$('#modalDetailSurat #action').html('');
						
						$('#modalDetailSurat #action').html(`
							<button class="btn btn-info" id="btnBuatBalasanDisposisi" data-id="${surat.id}"><i class="fa fa-edit"></i> Buat Balasan Disposisi</button>
							<button class="btn btn-info" id="btnSummaryDisposisi" data-id="${surat.id}"><i class="fa fa-search"></i> Lihat Summary Disposisi</button>
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