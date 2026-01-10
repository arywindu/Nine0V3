    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide alerts after 4 seconds
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 4000);
        
        // Confirm delete
        $('.btn-delete').click(function(e) {
            if (!confirm('Are you sure you want to delete this item?')) {
                e.preventDefault();
            }
        });

        // Mobile sidebar toggle (if needed)
        $(document).ready(function() {
            // Add mobile toggle functionality if hamburger menu exists
            $('.sidebar-toggle').click(function() {
                $('.admin-sidebar').toggleClass('show');
            });
        });
    </script>
</body>
</html>

