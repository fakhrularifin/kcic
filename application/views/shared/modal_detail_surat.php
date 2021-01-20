<!-- Modal -->

<div class="modal" id="modalDetailSurat" tabindex="-1" role="dialog" aria-labelledby="modalDetailSurat" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
	<div class="modal-content">
    
	<!-- <div class="panel-body"> -->

		<div class="modal-header">
			<div class="pull-left">
				<div class="modal-title" id="detailSuratTitle"></div>
                
				<span class="loadingState"></span>
			</div>
			<button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<div id="notaRevisi" class="px-4 py-2 d-none">
				<form>
					<input type="hidden" id="notaRevisiIdSurat">
					<input type="hidden" id="notaRevisiPenerima">
					<div class="form-group">
						<label for="notaRevisiInput">Nota Revisi</label>
						<textarea class="form-control html-editor" name="notaRevisiInput" id="notaRevisiInput"></textarea>
					</div>
					<button type="button" class="btn btn-primary" id="btnKirimNotaRevisi">Kirim</button>
					<button type="button" class="btn btn-secondary" id="btnBatalNotaRevisi">Batal</button>
				</form>
				<hr>
			</div>
			<div id="balasanDisposisi" class="px-4 py-2 d-none">
				<form>
					<input type="hidden" id="disposisiIdSurat">
					<div class="form-group">
						<label for="disposisiPenerima">Diteruskan Kepada</label>
						<input type="text" class="form-control search_user" id="disposisiPenerima"/>
					</div>
					<div class="form-group">
						<label for="disposisiPenerimaCc">CC</label>
						<input type="text" class="form-control search_multiuser" id="disposisiPenerimaCc"/>
					</div>
					<div class="form-group">
						<label for="balasanDisposisiInput">Balasan Disposisi</label>
						<textarea class="form-control html-editor" name="disposisiMemo" id="disposisiMemo"></textarea>
					</div>
					<button type="button" class="btn btn-primary" id="btnKirimBalasanDisposisi">Kirim</button>
					<button type="button" class="btn btn-secondary" id="btnBatalBalasanDisposisi">Batal</button>
				</form>
				<hr>
			</div>
			<div id="disposisiSummary" class="px-4 mb-4 d-none"></div>
			<!-- <div id="loop" class="px-4"></div> -->
			<div class="p-4">
            	<div id="detailSurat" class="p-4"></div>
                <div id="attachments" class="p-4"></div>
            </div>
		</div>
	<!-- </div> -->
    <div class="modal-footer">
    	<div id="action" class="text-right"></div>
	</div>
</div>
</div>
</div>