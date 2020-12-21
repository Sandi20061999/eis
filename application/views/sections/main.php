
<div id="app" class="col-12">
</div>
<div id="isi">
</div>

<style>
    .act-btn {
        background: #324cdd;
        display: block;
        width: 50px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        color: white;
        font-size: 30px;
        font-weight: bold;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        text-decoration: none;
        transition: ease all 0.3s;
        position: fixed;
        right: 30px;
        bottom: 30px;
    }

    .act-btn:hover {
        background: white;
        color: #324cdd;
    }
</style>
<a href="" class="act-btn" data-toggle="modal" data-target="#saran" data-backdrop="false">
    +
</a>
<div class="modal fade" id="saran" tabindex="-1" role="dialog" aria-labelledby="saranLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="saranLabel">Beri kami saran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="saranForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" aria-describedby="emailHelp" placeholder="Masukan Judul">
                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $this->session->userdata('user_id') ?>">
                    </div>
                    <div class="form-group">
                        <label for="ket">Saran</label>
                        <textarea name="ket" id="ket" class="form-control" rows="10">Masukan saran</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary btn-sm btnKirimSaran">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var baseUrl = '<?= base_url() ?>';
    $(".btnKirimSaran").on('click', function() {
        var data = $("#saranForm").serialize();
        console.log(data);
        $.ajax({
            url: baseUrl + "core_system/saran",
            type: "POST",
            dataType: "json",
            data: data,
            cache: false,
            success: function(data) {
                if (data !== 'sukses') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal...',
                        text: 'Gagal kirim saran ..',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#saran .close").click()
                        }
                    })
                } else {
                    $("#judul").val("");
                    $("#ket").val("");
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil...',
                        text: 'Berhasil kirim saran..',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#saran .close").click()
                        }
                    })
                }
            }
        })
    })
</script>