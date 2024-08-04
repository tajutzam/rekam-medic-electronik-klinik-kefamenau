<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>


<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <form method="post">
                <div class="form-group">
                    <label for="no_rm" class="form-label">NO RM</label>
                    <input type="text" class="form-control" id="no_rm" value="<?= $rm; ?>" readonly>
                </div>
                <!-- Tanda Tangan Online -->
                <div class="form-group">
                    <label for="signature-pad" class="form-label">Tanda Tangan</label>
                    <canvas id="signature-pad" class="form-control" style="border: 1px solid #ced4da; height: 200px; width: 400px;"></canvas>
                    <button type="button" id="clear" class="btn btn-warning mt-2">Clear</button>
                    <input type="hidden" name="signature" id="signature">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    document.getElementById('clear').addEventListener('click', function() {
        signaturePad.clear();
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        if (signaturePad.isEmpty()) {
            alert("Please provide a signature first.");
            e.preventDefault();
        } else {
            var dataURL = signaturePad.toDataURL('image/png');
            document.getElementById('signature').value = dataURL;
        }
    });
</script>