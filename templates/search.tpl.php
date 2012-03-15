<div class="search-results">
    <ul>
        <?php $row = 0; ?>
        <?php foreach ($results as $result): ?>
            <?php 
                 $details = array();
                 if ($result["type"] == "location" && isset($locationDetails[$result["id"]])) {
                     $details = $locationDetails[$result["id"]];
                 }
                 if ($result["type"] == "program" && isset($programDetails[$result["id"]])) {
                     $details = $programDetails[$result["id"]];
                 }
                 $row++;
                 $classes = ($row % 2 == 0) ? "even" : "odd";
                 if ($row == 1) $classes .= " first";
            ?>
            <li class="<?php echo $classes ?>">
                <img src="images/map-icon.png" class="icon" width="22" height="29" alt="" />
                <div class="materials">
                    <?php $num = 0; ?>
                    <?php if (isset($details["materials"])): ?>
                        <?php foreach ($details["materials"] as $material): ?>
                            <?php $num++; ?>
                            <?php if ($num < 9): ?>
                               <span class="material"><?php echo htmlspecialchars($material["description"]) ?></span>
                            <?php else: ?>
                                &hellip;
                                <?php break; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <h2>
                    <a href="<?php echo htmlspecialchars($result['url']) ?>">
                        <?php echo htmlspecialchars($result["description"]) ?></a>
                </h2>
                <div class="meta">
                    <?php if ($result["type"] == "location"): ?>
                        <?php echo htmlspecialchars($result["distance"]) ?> mi.
                    <?php endif; ?>
                    <?php echo $result["municipal"] ? "municipal" : "" ?>
                    <?php echo $result["curbside"] ? "curbside" : "" ?>
                    <?php echo htmlspecialchars($result["type"]) ?>
                </div>
                <?php if (isset($details["phone"])): ?>
                    <div class="phone">
                        <?php echo htmlspecialchars($details["phone"]) ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($details["address"])): ?>
                    <div class="address">
                        <?php if ($details["address"]): ?>
                            <?php echo htmlspecialchars($details["address"]) ?>,
                        <?php endif; ?>
                        <?php echo htmlspecialchars($details["city"]) ?>,
                        <?php echo htmlspecialchars($details["province"]) ?>
                        <?php echo htmlspecialchars($details["postal_code"]) ?>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<?php if ($pager->total() > 1): ?>
    <?php $nav = $pager->nav(); ?>
    <?php $window = $pager->window(10); ?>
                
    <div class="search-pager">
        <?php if ($pager->page > 1): ?>
            <a class="prev" href="<?php echo $baseUrl ?>&amp;page=<?php echo $nav['prev'] ?>">&laquo; Prev</a>
        <?php else: ?>
            <span class="no-prev">&laquo; Prev</span>
        <?php endif; ?>
        
        <?php foreach ($window['before'] as $i): ?>
            <a class="before" href="<?php echo $baseUrl ?>&amp;page=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endforeach; ?>

        <span class="current"><?php echo $nav['page'] ?></span>

        <?php foreach ($window['after'] as $i): ?>
            <a class="after" href="<?php echo $baseUrl ?>&amp;page=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endforeach; ?>
        
        <?php if ($pager->page < $pager->total()): ?>
              <a class="next" href="<?php echo $baseUrl ?>&amp;page=<?php echo $nav['next'] ?>">Next &raquo;</a>
        <?php else: ?>
            <span class="no-next">Next &raquo;</span>
        <?php endif; ?>
    </div>
<?php endif; ?>
