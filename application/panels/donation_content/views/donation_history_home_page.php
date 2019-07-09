</header>
<section class="sub-page-container">
    <div class="donation-history">
        <div class="content">
            <h2>Donation History </h2>
            <div class="responsive-table">
                <table>
                <tr>
                    <th>Name</th>
                    <th>Story Name</th>
                    <th>Date</th>
                    <th>Donations Amount</th>
                </tr>
                <?php if(!empty($result)){
                    foreach ($result as $key){?>
                            <tr>
                                <td><?php echo $key->user_name; ?></td>
                                <td><?php echo $key->story_name; ?></td>
                                <td><?php echo $key->donation_date_created; ?></td>
                                <td><?php echo "$".$key->donation_amount; ?></td>
                            </tr>
                <?php }
                }else{ ?>
                <tr align="center">
                    <td colspan="4" class="donation-td"><?php echo "No Record Found"; ?></td>
                </tr>
                <?php }?>
                    <tfoot>
                    <td colspan="5">
                        <div class="pagination_ci" style="float:right;"> <?php echo $paginglinks; ?></div>
                        <div class="pagination_ci" style="float:left;"> <?php echo (!empty($pagermessage) ? $pagermessage : ''); ?></div>
                    </td>
                    </tfoot>
                </table>
            </div>


        </div>	<!-- /end content -->
    </div>	<!-- /end projects-detail -->


</section>