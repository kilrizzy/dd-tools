@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="title">Character</h1>

    {{ Former::framework('TwitterBootstrap3') }}
    {{ Former::open_vertical() }}

    <div class="row">
        <div class="col-sm-3">
        {{ Former::text('name', 'Name')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('level', 'Level')->value($character->name) }}
        </div>
        <div class="col-sm-2">
        {{ Former::text('class', 'Class')->value($character->name) }}
        </div>
        <div class="col-sm-2">
        {{ Former::text('paragon_path', 'Paragon Path')->value($character->name) }}
        </div>
        <div class="col-sm-2">
        {{ Former::text('epic_destiny', 'Epic Destiny')->value($character->name) }}
        </div>
        <div class="col-sm-2">
        {{ Former::text('total_xp', 'Total XP')->value($character->name) }}
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
        {{ Former::text('race', 'Race')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('size', 'Size')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('age', 'Age')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('gender', 'Gender')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('height', 'Height')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('weight', 'Weight')->value($character->name) }}
        </div>
        <div class="col-sm-2">
        {{ Former::text('alignment', 'Alignment')->value($character->name) }}
        </div>
        <div class="col-sm-2">
        {{ Former::text('deity', 'Deity')->value($character->name) }}
        </div>
        <div class="col-sm-1">
        {{ Former::text('affiliations', 'Affiliations')->value($character->name) }}
        </div>
    </div> 

    <div class="row">
        <div class="col-sm-4">
            <h2>Initiative</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Score</th>
                        <th>&nbsp;</th>
                        <th>Dex</th>
                        <th>1/2 Level</th>
                        <th>Misc</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ Former::text('initiative[score]', '')->value($character->name) }}</td>
                        <td>Initiative</td>
                        <td>{{ Former::text('initiative[dex]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('initiative[half_level]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('initiative[misc]', '')->value($character->name) }}</td>
                    </tr>
                </tbody>
            </table>
            {{ Former::text('initiative[conditional_modifiers]', 'Conditional Modifiers')->value($character->name) }}
            <h2>Ability Scores</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Score</th>
                        <th>Ability</th>
                        <th>Abil Mod</th>
                        <th>Mod + 1/2 Level</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_list['ability_scores'] as $k=>$v)
                    <tr>
                        <td>{{ Former::text('ability_scores['.$k.'][score]', '')->value($character->name) }}</td>
                        <td>{{ $v }}</td>
                        <td>{{ Former::text('ability_scores['.$k.'][mod]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('ability_scores['.$k.'][half_level]', '')->value($character->name) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h2>Defenses</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Score</th>
                        <th>Defense</th>
                        <th>10 + 1/2 Level</th>
                        <th>Abil</th>
                        <th>Class</th>
                        <th>Feat</th>
                        <th>Enh</th>
                        <th>Misc</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_list['defenses'] as $k=>$v)
                    <tr>
                        <td>{{ Former::text('defenses['.$k.'][score]', '')->value($character->name) }}</td>
                        <td>{{ $v }}</td>
                        <td>{{ Former::text('defenses['.$k.'][half_level]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('defenses['.$k.'][abil]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('defenses['.$k.'][class]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('defenses['.$k.'][feat]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('defenses['.$k.'][enh]', '')->value($character->name) }}</td>
                        <td>{{ Former::text('defenses['.$k.'][misc]', '')->value($character->name) }}</td>
                    </tr>
                    <tr>
                        <td colspan="8">{{ Former::text('defenses['.$k.'][conditional_bonuses]', 'Conditional Bonuses')->value($character->name) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <h2>Movement</h2>
        </div>
    </div>
    <?php /*Former::select('role', 'Role')->options($data_list['roles'])->value($edituser->group)*/?>
    
    {{ Former::actions( Former::default_submit('Save') ) }}
    {{ Former::close() }}
</div>
@stop