<?php
$total_boxes = 30;
$boxes_per_page = 4; // 2x2
$lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit.";

for ($i = 1; $i <= $total_boxes; $i++) {
    // Start a new page
    if (($i - 1) % $boxes_per_page == 0) {
        if ($i > 1) echo '</div>'; // close previous page
        echo '<div class="page">';
    }
    
    echo '<div class="box"><p>' . $lorem . '</p></div>';
}

echo '</div>'; // close last page
?>
<style>
.page {
    width: 210mm;
    height: 275mm;
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    gap: 5mm;
    page-break-after: always;
}
.page:last-child { page-break-after: auto; }
.box {
    border: 1px solid #000;
    padding: 10px;
}
</style>
