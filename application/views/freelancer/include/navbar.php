<!-- Navbar -->
<?php if ($logged) { ?>
    <nav class="ps-navigation--dashboard">
        <ul>
            <li><a href="<?php echo base_url() . 'freelancer/dashboard'; ?>">Dashboard</a></li>
            <li><a href="<?php echo base_url() . 'freelancer/job/proposaljobs'; ?>" title="My Projects">Applied Projects</a></li>
            <li><a href="<?php echo base_url() . 'freelancer/job/acceptedProjects'; ?>" title="My Projects">Accepted Projects</a></li>
            <li><a href="<?php echo base_url() . 'freelancer/job/savedProjects'; ?>" title="My Projects">Bookmark</a></li>
            <li><a href="<?php echo base_url() . 'freelancer/profile'; ?>">My Profile</a></li>
        </ul>
    </nav>
    <script>
        $(function() {
            function loadNavbarActive() {
                let href = window.location.href;
                $('.ps-navigation--dashboard a[href="' + href + '"]').parent().addClass('active');
            }

            loadNavbarActive();
        });
    </script>
<?php } ?>