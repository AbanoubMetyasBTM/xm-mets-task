<div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
    <div class="grid grid-cols-1">
        <div class="p-6 table_view">
            <div class="row">
                <table class="table" border="1">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Open</td>
                            <td>High</td>
                            <td>Low</td>
                            <td>Close</td>
                            <td>Volume</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        /**
                         * @var \App\Types\ResponsePriceRow $price
                         */
                        ?>
                        @foreach($prices as $price)
                            <tr>
                                <td>{{$price->getDateFormatted()}}</td>
                                <td>{{$price->getOpen()}}</td>
                                <td>{{$price->getHigh()}}</td>
                                <td>{{$price->getLow()}}</td>
                                <td>{{$price->getClose()}}</td>
                                <td>{{$price->getVolume()}}</td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
