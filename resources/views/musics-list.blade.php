<div class="overflow-x-auto margin:10px;" >
                    <table class="min-w-full mt-3 mb-3">
    <thead >
        <tr style="display:none1;">
            <th style="width: 18% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-white uppercase tracking-wider" onclick="sortTable(2)">
                Hymn # <i id="hymnSortIcon" class="fas fa-sort"></i>
            </th>
            <th style="width: 35% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider" onclick="sortTable(1)">
                Title <i id="titleSortIcon" class="fas fa-sort"></i>
            </th>
         
            <th style="width: 25% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider">Category</th>
            <th style="width: 15% !important; white-space: normal;" scope="col" class="px-4 py-2 bg-gray-50 text-left text-s font-large text-white uppercase tracking-wider">Language</th>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                <th scope="col" class="px-4 py-2 bg-gray-50 text-center text-s font-large text-white uppercase tracking-wider">Action</th>
            @endif
        </tr>
    </thead>
    <tbody id="musicList" class="bg-white divide-y divide-gray-200">
        @foreach($musics as $index => $music)
        <tr class="hoverable">
            <td style="width: 18% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap text-center">
                {{ $music->song_number }}
            </td>
            <td style="width: 35% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                <a href="{{ route('musics.show', $music->id) }}" class="flex items-center">
                    <i class="fas fa-music" style="margin-right: 12px; margin-left: 4px;color:#50727B;"></i>
                    {{ $music->title }}
                </a>
            </td>
         
            <td style="width: 25% !important; white-space: normal;" class="px-4 py-3 whitespace-normal">
                @foreach($music->categories as $category)
                    {{ $loop->first ? '' : ', ' }}{{ $category->name }}
                @endforeach
            </td>
            <td style="width: 15% !important; white-space: normal;" class="px-4 py-3 whitespace-nowrap">
                {{ $music->language->name }}
            </td>
            @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.action') == 'inline')
                <td class="px-4 py-3 whitespace-nowrap text-center">
                    <div class="flex justify-center items-center space-x-4">
                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.edit') == 'inline')
                            <a href="{{ route('musics.edit', $music->id) }}" class="btn btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif

                        @if (\App\Helpers\AccessRightsHelper::checkPermission('musics.delete') == 'inline')
                            <form id="deleteForm{{$music->id}}" method="POST" action="{{ route('musics.destroy', $music->id) }}" style="display: inline;margin-top:16px;margin-left:3px;">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{$music->id}})" class="btn btn-secondary">
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
</div>