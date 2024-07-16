<style>
    
    .container {
        display: flex;
        justify-content: center;
    }
</style>

<div class="container text-center">
            {{ $musics->appends(['query' => request()->query('query')])->links('pagination::bootstrap-4') }}
        </div>
        
        <table class="min-w-full mt-3 mb-3">
    <thead>
        <tr>
            <th style="width: 18% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-white uppercase tracking-wider" onclick="sortTable(2)">
                Hymn # <i id="hymnSortIcon" class="fas fa-sort"></i>
            </th>
            <th style="width: 35% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider" onclick="sortTable(1)">
                Title <i id="titleSortIcon" class="fas fa-sort"></i>
            </th>
            <th style="width: 25% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider">Category</th>
            <th style="width: 15% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider">Language</th>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') || \App\Helpers\AccessRightsHelper::checkPermission('musics.delete'))
                <th style="width: 20% !important; white-space: normal;" scope="col" class="relative px-6 py-2 bg-gray-50">
                    <span class="sr-only">Action</span>
                </th>
            @endif
        </tr>
    </thead>
    <tbody id="musicList">
        @foreach($musics as $music)
            <tr id="row-{{ $music->id }}" class="bg-white border-b border-gray-300 hover:bg-gray-50 text-sm">
                <td style="width: 18% !important; white-space: normal;" class="px-4 py-2 text-center font-medium text-gray-900 whitespace-nowrap dark:text-black">
                    <a href="{{ route('musics.show', ['music' => $music->id]) }}" class="text-blue-500 hover:text-blue-600">
                        {{ $music->song_number }}
                    </a>
                </td>
                <td style="width: 35% !important; white-space: normal;" class="px-4 py-2 text-left font-medium text-gray-900 whitespace-nowrap dark:text-black">
                    <a href="{{ route('musics.show', ['music' => $music->id]) }}" class="text-blue-500 hover:text-blue-600">
                        {{ $music->title }}
                    </a>
                </td>
                <td style="width: 25% !important; white-space: normal;" class="px-4 py-2 text-left font-medium text-gray-900 whitespace-nowrap dark:text-black">
                    @foreach($music->categories as $category)
                        <span class="inline-block bg-gray-200 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $category->name }}</span>
                    @endforeach
                </td>
                <td style="width: 15% !important; white-space: normal;" class="px-4 py-2 text-left font-medium text-gray-900 whitespace-nowrap dark:text-black">
                    @if ($music->language)
                        <span class="inline-block bg-gray-200 text-gray-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">{{ $music->language->name }}</span>
                    @endif
                </td>
                @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') || \App\Helpers\AccessRightsHelper::checkPermission('musics.delete'))
                    <td style="width: 20% !important; white-space: normal;" class="px-4 py-2 text-center font-medium text-gray-900 whitespace-nowrap dark:text-black">
                        <div class="flex justify-center space-x-2">
                            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action'))
                                <a href="{{ route('musics.edit', ['music' => $music->id]) }}" class="text-blue-500 hover:text-blue-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.delete'))
                                <form action="{{ route('musics.destroy', ['music' => $music->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this hymn?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
<div class="container text-center">
            {{ $musics->appends(['query' => request()->query('query')])->links('pagination::bootstrap-4') }}
        </div>