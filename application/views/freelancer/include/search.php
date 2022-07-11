<?php
    $searchQuery = isset($searchQuery) ? $searchQuery : '';
?>

<form action="#" id="jobSearch" class="form" style="border-radius: 20px; position: relative;
    display: flex;
    justify-content: center;">
    <input type="text" name="search" value="<?php echo $searchQuery; ?>" placeholder="SEARCH JOBS" style="
    background-color: white;
    border: 1px solid white;
    border-radius: 25px;
    padding: 20px;">
    <button style="display: none !important;"><i data-feather="search"></i></button>
</form>

<?php $this->document->addScript(base_url() . 'application/assets/js/include/freelancer/search.js', 'footer'); ?>
