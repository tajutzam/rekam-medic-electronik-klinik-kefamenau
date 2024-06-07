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

<script>
    $(document).ready(function() {
        $('#example2').DataTable();
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    });
</script>

</body>

</html>