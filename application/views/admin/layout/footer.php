    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Auto-hide alerts
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 3000);
        
        // Confirm delete
        $('.btn-delete').click(function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
