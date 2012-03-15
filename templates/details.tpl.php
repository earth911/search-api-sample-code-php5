<?php if (!$details): ?>
    <br />
    <h1>404 - Page not found</h1>
    <p>Sorry, the page you requested could not be found.</p>
<?php else: ?>
    <div class="search-details">
        <?php if ($searchArgs->what && $searchArgs->where): ?>
            <div class="back-link">
                &laquo; <a href="search.php?<?php echo htmlspecialchars($searchArgs->queryString()) ?>">Back to search results</a>
                for &ldquo;<?php echo htmlspecialchars($searchArgs->what)?>&rdquo;
                near &ldquo;<?php echo htmlspecialchars($searchArgs->where)?>&rdquo;
            </div>
        <?php endif; ?>

        <div class="contact">
            <?php if ($details["phone"]): ?>
                <div class="phone">
                    <?php echo htmlspecialchars($details["phone"])?>
                </div>
            <?php endif; ?>
            <?php if ($details["address"]): ?>
                <div class="address">
                    <?php if ($details["address"]): ?>
                        <?php echo htmlspecialchars($details["address"]) ?><br />
                    <?php endif; ?>
                    <?php echo htmlspecialchars($details["city"]) ?>,
                    <?php echo htmlspecialchars($details["province"]) ?>
                    <?php echo htmlspecialchars($details["postal_code"]) ?>
                </div>
            <?php endif; ?>
        </div>

        <h1><?php echo htmlspecialchars($details["description"]) ?></h1>

        <div class="notes"><?php echo htmlspecialchars($details["notes"]) ?></div>

        <div class="hours"><?php echo htmlspecialchars($details["hours"]) ?></div>

        <?php if ($details["url"]): ?>
            <div class="website">
                <a href="<?php echo htmlspecialchars($details["url"])?>">
                    <?php echo htmlspecialchars($details["url"])?></a>
            </div>
        <?php endif; ?>

        <table>
            <tr>
                <th width="33%">Materials Accepted</th>
                <th colspan="2">Services</th>
                <th width="50%">&nbsp;</th>
            </tr>
            <tr class="subhead">
                <th>Material</th>
                <th>Residential</th>
                <th>Business</th>
                <th>Notes</th>
            </tr>
            <?php $row = 0; ?>
            <?php foreach ($details["materials"] as $material): ?>
               <?php
                   $row++;
                   $classes = ($row % 2 == 0) ? "even" : "odd";
                   if ($row == 1) $classes += " first";
               ?>
               <tr class="<?php echo $classes ?>">
                    <td><?php echo htmlspecialchars($material["description"]) ?></td>
                    <td><?php echo htmlspecialchars($material["residential_method"]) ?></td>
                    <td><?php echo htmlspecialchars($material["business_method"]) ?></td>
                    <td><?php echo htmlspecialchars($material["notes"]) ?></td>
               </tr>
            <?php endforeach; ?>
        </table>
    </div>
<?php endif; ?>
