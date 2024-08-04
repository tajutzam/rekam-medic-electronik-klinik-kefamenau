<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> <!-- Memuat jQuery dari URL eksternal -->
<!-- Bootstrap 4 -->
<script src="<?= base_url('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('AdminLTE/dist/js/adminlte.min.js') ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('AdminLTE/dist/js/demo.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('AdminLTE/plugins/select2/js/select2.full.min.js'); ?>"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example2').DataTable();
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    });

    $(function() {
        <?php if (session()->has("success")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '<?= session('success') ?>'
            })
        <?php } ?>

        <?php if (session()->has("error")) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= session('error') ?>'
            })
        <?php } ?>

        <?php if (session()->has("errors")) { ?>
            <?php
            $errors = session('errors');
            $errorMessage = implode('\n', $errors);; ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= $errorMessage ?>'
            })
        <?php } ?>
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const diagnosaContainer = document.getElementById('diagnosa-container');
        const tindakanContainer = document.getElementById('tindakan-container');

        function addEventListenersForDiagnosa() {
            const diagnosaSelects = document.querySelectorAll('.diagnosa-select');
            const diagnosaValues = document.querySelectorAll('.diagnosa-value');
            diagnosaSelects.forEach((select, index) => {
                select.addEventListener('change', function() {
                    const selectedOption = select.options[select.selectedIndex];
                    diagnosaValues[index].value = selectedOption.text.split(' - ')[1];
                });
            });
        }

        function addEventListenersForTindakan() {
            const tindakanSelects = document.querySelectorAll('.tindakan-select');
            const tindakanValues = document.querySelectorAll('.tindakan-value');
            tindakanSelects.forEach((select, index) => {
                select.addEventListener('change', function() {
                    const selectedOption = select.options[select.selectedIndex];
                    tindakanValues[index].value = selectedOption.text.split(' - ')[1];
                });
            });
        }

        document.querySelector('.add-diagnosa-btn').addEventListener('click', function() {
            const newDiagnosaRow = document.querySelector('.diagnosa-row').cloneNode(true);
            newDiagnosaRow.querySelector('select').value = '';
            newDiagnosaRow.querySelector('.diagnosa-value').value = '';
            diagnosaContainer.appendChild(newDiagnosaRow);
            addEventListenersForDiagnosa();
        });

        document.querySelector('.add-tindakan-btn').addEventListener('click', function() {
            const newTindakanRow = document.querySelector('.tindakan-row').cloneNode(true);
            newTindakanRow.querySelector('select').value = '';
            newTindakanRow.querySelector('.tindakan-value').value = '';
            tindakanContainer.appendChild(newTindakanRow);
            addEventListenersForTindakan();
        });

        addEventListenersForDiagnosa();
        addEventListenersForTindakan();
    });
</script>


</body>

</html>