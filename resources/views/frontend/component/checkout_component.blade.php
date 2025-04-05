<li>
    <a id="fee-ship-checkout">
        <p class="col subtotal-title"> Phí ship:</p>
        <span>
             {{$feeship}} đ
        </span>
    </a>
</li>
<li>
    <a class="summary-main table" id="total-checkout" href="#">
        <p class="col total-title">Tổng tiền:</p>
        <?php
            $totalProduct = intval(str_replace('.', '', $totalProduct)); 
            $feeship = intval(str_replace('.', '', $feeship));
            $total_after_feeship = $totalProduct + $feeship;
            $total_after_feeship = number_format($total_after_feeship,0, ',', '.');
        ?>
        <span class="col text-right">
            <?php echo $total_after_feeship ?> đ </span>
    </a>
</li>

