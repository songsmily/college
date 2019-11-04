@foreach($questions as $question)

    <fieldset id="Q{{$question['id']}}_Field" class="question chooseone list" role="radiogroup">
        <a id="Q{{$question['id']}}_HEADING" class="question-heading anchor"></a>
        <span class="question-text" id="Q{{$question['id']}}_Question">{{$loop->iteration}}、{{$question['tittle']}}</span>
        <div class="response-area">
            <ol class="response-set">
                <li id="Q{{$question['id']}}_Li" for="Q{{$question['id']}}Option1" class="response select-area">
                    <input class="option_label" type="checkbox" name="Q{{$question['id']}}" value="A" id="Q{{$question['id']}}Option1">
                    <label class="option_label" for="Q{{$question['id']}}Option1" class="choice-text">{{$question['option1']}}</label>
                </li>

                <li id="Q{{$question['id']}}_Li" for="Q{{$question['id']}}Option2" class="response select-area">
                    <input class="option_label" type="checkbox" name="Q{{$question['id']}}" value="B" id="Q{{$question['id']}}Option2">
                    <label class="option_label" for="Q{{$question['id']}}Option2" class="choice-text">{{$question['option2']}}</label>
                </li>

                <li id="Q{{$question['id']}}_Li" for="Q{{$question['id']}}Option3" class="response select-area">
                    <input class="option_label" type="checkbox" name="Q{{$question['id']}}" value="C" id="Q{{$question['id']}}Option3">
                    <label class="option_label" for="Q{{$question['id']}}Option3" class="choice-text">{{$question['option3']}}</label>
                </li>

                <li id="Q{{$question['id']}}_Li" for="Q{{$question['id']}}Option4" class="response select-area">
                    <input class="option_label" type="checkbox" name="Q{{$question['id']}}" value="D" id="Q{{$question['id']}}Option4">
                    <label class="option_label" for="Q{{$question['id']}}Option4" class="choice-text">{{$question['option4']}}</label>
                </li>


            </ol>
        </div>
    </fieldset>

@endforeach