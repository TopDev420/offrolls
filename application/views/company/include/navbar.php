<?php if ($logged) { ?>
    <nav class="ps-navigation--dashboard">
        <ul>
            <li><a href="<?php echo base_url() . 'company/dashboard'; ?>">Dashboard</a></li>
            <li><a href="<?php echo base_url() . 'company/jobs/freelancer/listPublishedJobs'; ?>" title="All Projects">&nbsp;Active Projects</a></li>
            <li><a href="<?php echo base_url() . 'company/jobs/freelancer/listDraftedJobs'; ?>" title="All Projects">&nbsp;Drafted Projects</a></li>
            <!-- <li><a href="#">Bookmark</a></li> -->
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