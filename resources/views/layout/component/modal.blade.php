<div class="modal fade" id="modal-select" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#007bff;color:white">
        <h5 class="modal-title" id="select-box-title">Modal title</h5>
        <button type="button" class="close" id="btn-close-modal-select" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="input-group mb-3">
                  <input type="text" class="form-control form-control-sm search-select mr-3" placeholder="Tìm kiếm">
                  <button class="btn btn-success select-add-element btn-sm" data-name="" data-route="" type="button"><i class="fas fa-plus-circle"></i>Thêm</button>
                </div>
              </div>
              <div class="col-lg-6" id="show-page-select">
                {{-- show page --}}
              </div>
            </div>
          </div>
          <div class="col-lg-12 table-wrapper-scroll-y my-custom-scrollbar" id="show-table-select">
            {{-- show conten  --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
