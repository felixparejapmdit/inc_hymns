<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Include Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Include jQuery before Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
body {
  background: linear-gradient(to bottom, #5eb8d3, #4975b4);
}
       .flex-1:hover {
    background-color:#050C9C;
}
    /* Small screens (max-width: 640px) */
@media (max-width: 640px) {
   .flex {
        flex-direction: column;
    }
   .bg-gray-100 {
        margin-bottom: 20px;
    }
    table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    th, td {
        display: inline-block;
        vertical-align: top;
        min-width: 100px;
        margin-right: 10px;
    }
    .flex-1:hover {
    background-color:#f7f7f7;
}
}

/* Medium screens (min-width: 641px and max-width: 1024px) */
@media (min-width: 641px) and (max-width: 1024px) {
   .flex {
        flex-direction: row;
    }
   .bg-gray-100 {
        margin-bottom: 0;
    }
    .flex-1:hover {
    background-color:#f7f7f7;
}
.table-font-size {
    font-size: 3vw;
  }
}

/* Large screens (min-width: 1025px) */
@media (min-width: 1025px) {
   .flex {
        flex-direction: row;
    }
   .bg-gray-100 {
        margin-bottom: 0;
    }
    .flex-1:hover {
    background-color:#f7f7f7;
    
}

.table-font-size {
    font-size: 1.5vw;
  }
}

/* Add this to your CSS file or <style> block */
.table-font-size {
  font-size: 1vw;
}


/* Media queries to adjust font size based on screen width */
@media only screen and (max-width: 1024px) {
 .table-font-size {
    font-size: 3.5vw;
  }
}

/* Media queries to adjust font size based on screen width */
@media only screen and (max-width: 820px) {
 .table-font-size {
    font-size: 3.5vw;
  }
}


/* Media queries to adjust font size based on screen width */
@media only screen and (max-width: 768px) {
 .table-font-size {
    font-size: 3.5vw;
  }
}

@media only screen and (max-width: 480px) {
 .table-font-size {
    font-size: 5vw;
  }
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg mt-4" style="border-radius:2rem;">
                <div class="p-6 bg-blue" style="background-color: #79b7de;">
                <div class="flex mt-8 gap-4">
    <table class="min-w-full bg-blue w-full" style="background-color: #79b7de;">
        <thead>
        <tr> 
  <th style="background-color: #79b7de;" class="py-4 px-6 text-center table-font-size"><span style="text-transform: uppercase;color:white">HYMNS COUNT</span></th> 
  <th style="background-color: #79b7de;" class="py-4 px-6 text-left table-font-size"><span style="text-transform: uppercase;color:white">DESCRIPTION</span></th> 
</tr>
        </thead>
        <tbody>
            @php
                $colors = ['FEFDFF', 'FEFDFF', 'FEFDFF', 'FEFDFF'];
                $colorText = ['32012F', '32012F', '32012F', '32012F'];
                $colorIndex = 0;
            @endphp

            @foreach($totalChurchHymns as $hymn)
                @php
                    $serviceName = '';
                    switch($hymn->name) {
                        case 'AWS':
                            $serviceName = 'Adult Worship Service';
                            break;
                        case 'CWS':
                            $serviceName = 'Children Worship Service';
                            break;
                        case 'EM':
                            $serviceName = 'Evangelical Mission';
                            break;
                        case 'Wedding':
                            $serviceName = 'Wedding';
                            break;
                    }
                    $currentTextColor = $colorText[$colorIndex];
                @endphp

                @if($hymn->musics_count > 0)
        <tr style="background-color: #{{ $colors[$colorIndex] }};">
            <td class="py-8 px-6 text-center" style="color: #{{ $currentTextColor }}; padding: 20px; border-radius: 20px 0 0 20px;">
                <a href="{{ route('musics.index', ['church_hymn_id' => $hymn->id]) }}" class="table-font-size" style="text-decoration: none; color: #{{ $currentTextColor }};">{{ $hymn->musics_count }}</a>
            </td>
            <td class="py-8 px-6 text-left" style="color: #{{ $currentTextColor }}; font-size: 18px; padding: 20px; border-radius: 0 20px 20px 0;">
                <a href="{{ route('musics.index', ['church_hymn_id' => $hymn->id]) }}" class="table-font-size" style="text-decoration: none; color: #{{ $currentTextColor }}">{{ $serviceName }}</a>
            </td>
        </tr>
    @else
        <tr style="background-color: #{{ $colors[$colorIndex] }};">
            <td class="py-8 px-6 text-center table-font-size" style="color: #{{ $currentTextColor }}; padding: 20px; border-radius: 20px 0 0 20px;">{{ $hymn->musics_count }}</td>
            <td class="py-8 px-6 text-left table-font-size" style="color: #{{ $currentTextColor }}; padding: 20px; border-radius: 0 20px 20px 0;">{{ $serviceName }}</td>
        </tr>
    @endif
    <!-- Add spacing row -->
    <tr style="height: 20px;"></tr>


                @php
                    $colorIndex = ($colorIndex + 1) % count($colors);
                @endphp
            @endforeach

       <!-- Hymns of Music Count -->
<tr style="background-color: #79b7de;">
    <td class="py-8 px-6 text-center table-font-size" style="color: white; padding: 20px; border-radius: 20px 0 0 20px; border-top: 4px solid white;">{{ $totalChurchHymns->sum('musics_count') }}</td>
    <td class="py-8 px-6 text-left table-font-size" style="color: white; padding: 20px; border-radius: 0 20px 20px 0; border-top: 4px solid white;">TOTAL HYMNS</td>
</tr>

            <!-- Users Count (hidden) -->
            @if($totalUsers > 0)
                <tr style="background-color: #FEFDFF; border: 3px solid #686D76; display:none;">
                    <td class="py-4 px-6 border-b border-gray-300 border-r text-center" style="color:#32012F;">{{ $totalUsers }}</td>
                    <td class="py-4 px-6 border-b border-gray-300 text-center" style="color:#32012F; font-size: 18px;">Users</td>
                </tr>
            @else
                <tr style="background-color: #FEFDFF; border: 3px solid #686D76; display:none;">
                    <td class="py-4 px-6 border-b border-gray-300 border-r text-center" style="color:#32012F;">{{ $totalUsers }}</td>
                    <td class="py-4 px-6 border-b border-gray-300 text-center" style="color:#32012F; font-size: 18px;">Users</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="flex mt-8 gap-4">
asd
                </div>

                    @if (\App\Helpers\AccessRightsHelper::checkPermission('dashboard.hymns_info') == 'inline')

                    <div class="flex mt-8 gap-4 mt-4">
                                                
                    <!-- Most Viewed Hymns -->
                    <div class="w-full px-2">
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold mb-4">Most Viewed Hymns</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white mb-2">
                                        <thead>
                                            <tr>
                                            <th style="width: 30%;" class="text-center py-2 px-4 border-b border-gray-300">Hymn #</th>
                                                <th style="width: 30%;" class="text-center py-2 px-4 border-b border-gray-300">Title</th>
                                                <th style="width: 30%;" class="text-center py-2 px-4 border-b border-gray-300">Views Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($mostViewedHymns as $index => $hymn)
                                                <tr>
                                                <td style="width: 30%;" class="text-center py-2 px-4 border-b border-gray-300">{{ $hymn->song_number }}</td>
                                                    <td style="width: 30%;" class="py-2 px-4 border-b border-gray-300">
                                                        <a href="{{ route('musics.show', $hymn->id) }}" class="flex items-center">
                                                            <i class="fas fa-music" style="margin-right: 12px; margin-left: 4px;color:#50727B;"></i>
                                                            {{ $hymn->title }}
                                                        </a>
                                                    </td>
                                                    
                                                    <td style="width: 30%;" class="text-center py-2 px-4 border-b border-gray-300">{{ $hymn->views_count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $mostViewedHymns->links() }}
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="flex mt-8 gap-4 mt-4">
                            <!-- Recent Activity -->
                            <div class="bg-gray-100 p-4 rounded-lg shadow  w-full md:w-1/2">
                                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                                
                                    <table class="min-w-full bg-white">
                                        <thead>
                                            <tr>
                                                <th class="py-2 px-4 border-b border-gray-300">Date</th>
                                                <th class="py-2 px-4 border-b border-gray-300">User</th>
                                                <th class="py-2 px-4 border-b border-gray-300">Action</th>
                                                <th class="py-2 px-4 border-b border-gray-300">Item</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($logs as $activity)
                                                <tr>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ optional($activity->user)->name }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $activity->action }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">
                                                        {{ $activity->model? class_basename($activity->model). 'ID: '. $activity->model_id. ')' : '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="overflow-x-auto mt-4">
                                    {{ $logs->links() }}
                                </div>
                            
                        
                            </div>

                            <div class="bg-gray-100 p-4 rounded-lg shadow  w-full md:w-1/2">
                            <h3 class="text-lg font-semibold mb-4">Hymns Chart</h3>
                                <div style="position: relative; height: 350px; width: 100%;">
                                    <canvas id="churchHymnsChart" style="position: absolute; left: 0; top: 0; bottom: 0; right: 0; width: 100%; height: 100%;"></canvas>
                                </div>
                            </div>

                                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <script>
                                // Extract labels and data from PHP variables
                                var labels = [];
                                var data = [];
                                var hymnCounts = []; // Array to hold hymn counts for tooltips

                                @foreach($totalChurchHymns as $hymn)
                                    labels.push('{{ $hymn->name }}');
                                    data.push({{ $hymn->musics_count }});
                                    hymnCounts.push('{{ $hymn->musics_count }}');
                                @endforeach

                                // Create the chart only if both labels and data arrays are not empty
                                if (labels.length > 0 && data.length > 0) {
                                    // Get the context of the canvas element
                                    var ctx = document.getElementById('churchHymnsChart').getContext('2d');

                                    // Define the dataset for the chart
                                    var dataset = {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Church Hymns',
                                            data: data,
                                            backgroundColor: [
                                                'rgba(2, 62, 138, 1)',
                                                'rgba(0, 119, 182, 1)',
                                                'rgba(0, 150, 199, 1)',
                                                'rgba(0, 180, 216, 1)',
                                                'rgba(153, 102, 255, 0.2)',
                                                'rgba(255, 159, 64, 0.2)'
                                            ],
                                            borderColor: [
                                                'rgba(2, 62, 138, 1)',
                                                'rgba(0, 119, 182, 1)',
                                                'rgba(0, 150, 199, 1)',
                                                'rgba(0, 180, 216, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    };

                                    // Define the chart options
                                    var options = {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        tooltips: {
                                            callbacks: {
                                                label: function(tooltipItem, data) {
                                                    var label = data.labels[tooltipItem.index];
                                                    var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                                                    return label + ': ' + value + ' Hymns';
                                                }
                                            }
                                        },
                                        legend: {
                                            display: true,
                                            position: 'right',
                                        }
                                    };

                                    // Create the chart
                                    var churchHymnsChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: dataset,
                                        options: options
                                    });
                                }
                            </script>

                        </div>

                        <div class="flex mt-8 gap-4 mt-6 mb-6">             
                            <!-- Hymns by Language -->
                            <div class="bg-gray-100 p-4 rounded-lg shadoww-full md:w-1/2">
                                    <h3 class="text-lg font-semibold mb-4"># Hymns by Language</h3>
                                    <table class="min-w-full bg-white">
                                        <thead>
                                            <tr>
                                                <th class="py-2 px-4 border-b border-gray-300">#</th>
                                                <th class="py-2 px-4 border-b border-gray-300">Language</th>
                                                <th class="py-2 px-4 border-b border-gray-300">Hymns Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($languageCounts as $index => $languageCount)
                                                <tr>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $index + 1 }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $languageCount->name }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $languageCount->musics_count }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>

                            <!-- Hymn Categories Chart -->
<div class="w-full md:w-1/2">
    <div class="bg-gray-100 p-4 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Hymn Categories Chart</h3>
        <div class="overflow-x-auto" style="position: relative; height: 400px;">
            <canvas id="hymnCategoriesChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Extract labels and data from PHP variables
    var labels = [];
    var data = [];

    @foreach($categoryCounts as $categoryCount)
        labels.push('{{ $categoryCount->category_name }}');
        data.push({{ $categoryCount->musics_count }});
    @endforeach

    // Create the chart only if both labels and data arrays are not empty
    if (labels.length > 0 && data.length > 0) {
        // Get the context of the canvas element
        var ctx = document.getElementById('hymnCategoriesChart').getContext('2d');

        // Define the dataset for the chart
        var dataset = {
            labels: labels,
            datasets: [{
                label: 'Hymns per Category',
                data: data,
                backgroundColor: 'rgba(0, 119, 182, 0.7)',
                borderColor: 'rgba(0, 119, 182, 1)',
                borderWidth: 1
            }]
        };

        // Define the chart options
        var options = {
            responsive: true,
            maintainAspectRatio: false,
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.labels[tooltipItem.index];
                        var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                        return label + ': ' + value + ' Hymns'; 
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return value; 
                        }
                    }
                }
            },
            legend: {
                display: false,
            }
        };

        // Create the chart
        var churchHymnsChart = new Chart(ctx, {
            type: 'bar',
            data: dataset,
            options: options
        });
    }
</script>

                        </div>

                        <div class="flex mt-8 gap-4 mt-6 mb-6">
                            

                            <!-- Instrumentations -->
                            <div class="w-full md:w-1/2">
                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold mb-4">Hymn Instrumentations</h3>
                                    <table class="min-w-full bg-white">
                                        <thead>
                                            <tr>
                                                <th class="py-2 px-4 border-b border-gray-300">#</th>
                                                <th class="py-2 px-4 border-b border-gray-300">Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($instrumentations as $instrumentation)
                                                <tr>
                                                <td style="width: 5%;" class="py-2 px-4 border-b border-gray-300">{{ $loop->iteration }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $instrumentation->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- View All Button -->
                                    <div class="text-center mt-4">
                                        <a href="{{ route('instrumentations.index') }}" class="btn btn-primary">View All</a>
                                    </div>
                                </div>

                            </div>

                                  <!-- Ensemble Types -->
                                  <div class="w-full md:w-1/2">
                                <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h3 class="text-lg font-semibold mb-4">Hymn Ensemble Types</h3>
                                    <table class="min-w-full bg-white">
                                        <thead>
                                            <tr>
                                                <th class="py-2 px-4 border-b border-gray-300">#</th>
                                                <th class="py-2 px-4 border-b border-gray-300">Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ensembleTypes as $ensembleType)
                                                <tr>
                                                    <td style="width: 5%;" class="py-2 px-4 border-b border-gray-300">{{ $loop->iteration }}</td>
                                                    <td class="py-2 px-4 border-b border-gray-300">{{ $ensembleType->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- View All Button -->
                                    <div class="text-center mt-4">
                                        <a href="{{ route('ensemble_types.index') }}" class="btn btn-primary">View All</a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="flex mt-8 gap-4 mt-6 mb-6">
    <!-- Hymn Categories -->
    <div class="w-full md:w-1/2">
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Hymn Categories</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th style="width: 10%;" class="py-2 px-4 border-b border-gray-300">#</th>
                            <th style="width: 90%;" class="py-2 px-4 border-b border-gray-300">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td style="width: 10%;" class="py-2 px-4 border-b border-gray-300">{{ $loop->iteration }}</td>
                                <td style="width: 90%;" class="py-2 px-4 border-b border-gray-300">{{ $category->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View All Button -->
            <div class="text-center mt-4">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>

    <!-- Hymn Credits -->
    <div class="flex-grow w-full md:w-1/2">
        <div class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-4">Hymn Credits</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th style="width: 10%;" class="py-2 px-4 border-b border-gray-300">#</th>
                            <th style="width: 90%;" class="py-2 px-4 border-b border-gray-300">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($credits as $credit)
                            <tr>
                                <td style="width: 10%;" class="py-2 px-4 border-b border-gray-300">{{ $loop->iteration }}</td>
                                <td style="width: 90%;" class="py-2 px-4 border-b border-gray-300">{{ $credit->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- View All Button -->
            <div class="text-center mt-4">
                <a href="{{ route('credits.index') }}" class="btn btn-primary">View All</a>
            </div>
        </div>
    </div>
</div>

<style>
    .pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination-container .pagination {
    display: inline-flex;
}

.pagination-container .pagination li {
    margin: 0 10px;
}

.pagination-container .pagination li a {
    padding: 10px 20px;
    border-radius: 5px;
    background-color: #f7f7f7;
    color: #333;
    text-decoration: none;
}

.pagination-container .pagination li a:hover {
    background-color: #eee;
}
</style>

                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
