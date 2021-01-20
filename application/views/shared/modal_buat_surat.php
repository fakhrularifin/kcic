<!-- Modal -->
<div class="modal fade" id="modalBuatSurat" tabindex="-1" role="dialog" aria-labelledby="modalBuatSurat" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<form id="formBuatSurat" enctype="multipart/form-data">
	<div class="modal-content">
	<!-- start panel body -->
    	<div class="panel-body">
		
			
		<div id="modalFormArea" class="m-4">
			
				<input type="hidden" name="idSurat" id="idSurat">
				<div class="form-group">
						<label for="nomorSurat">Nomor Surat</label>
						<input type="text" class="form-control" name="nomorSurat" id="nomorSurat" /><br />
						<select name="jenisSurat" id="jenisSurat" class="form-control">
							<option value="">-- Jenis Surat --</option>
							<option value="SURAT_KELUAR">Surat Keluar</option>
							<option value="NOTA_DINAS">Nota Dinas</option>
							<option value="DISPOSISI">Disposisi</option>
						</select>
				</div>
				<div class="form-group">
					<span>Kepada</span><input id="penerima" name="penerima" type="text" class="form-control search_user" placeholder="email tujuan">
				</div>
				<div class="form-group">
					<label for="penerimaCc">CC</label>
					<input type="text" class="form-control search_multiuser" name="penerimaCc" id="penerimaCc" placeholder="email tembusan" />
				</div>
				<div class="form-group d-none" id="tanggalTerimaSuratInput">
					<label for="tanggalTerimaSurat">Tanggal Terima Surat</label>
					<input type="text" class="form-control date_form" name="tanggalTerimaSurat" id="tanggalTerimaSurat" />
				</div>
				<div class="form-group">
					<label for="perihal">Perihal</label>
					<input type="text" class="form-control" name="perihal" id="perihal" />
				</div>
				<div class="form-group">
					<label for="sifat">Sifat Surat</label>
					<select class="form-control" name="sifat" id="sifat">
						<option value="">-- Sifat Surat --</option>
						<option value="NORMAL">Normal</option>
						<option value="URGENT">Urgent</option>
					</select>
				</div>
				<div class="form-group d-none" id="rujukanInput">
					<label for="rujukan">Surat Rujukan</label>
					<input type="text" class="form-control" name="rujukan" id="rujukan" />
				</div>
				<div class="form-group">
					<label for="memo">Memo</label>
					<textarea id="memo" name="memo" class="html-editor"></textarea>
				</div>
				<div class="form-group" id="attachments">
					<label for="attachments">Attachments</label>
					<input type="file" class="form-control" name="attachments" id="attachments"/>
				</div>
				<div class="form-group">
					<label for="lampiran">Keterangan Lampiran</label>
					<input type="text" class="form-control" name="lampiran" id="lampiran" />
				</div>
				
		</div>
	</div>
    <!-- end panel body -->
	<div class="panel-footer">
    	<div id="action" class="text-right"> 
        <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i> Kirim</button>
		</div>
	</div>
    </div>
	</form>
</div>
</div>
