@extends('master_page')

@section('content')
<div>
    <h3 >Product Review</h3>
    <table class="table table-responsive">
        <thead>
          <tr class="trHeight">
            <th class="tdLeft">Feature</th>
            <th class="tdRight">Vote</th>
          </tr>
        </thead>
        <tbody class="tbodyHeight">
          <tr class="trHeight">
            <td class="tdLeft">Screen</td>
            <td class="tdRight">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option2"  autocomplete="off"><p class="inline pRed">&#128078;</p></input>
                    </label>
                </div>
            </td>
          </tr>
          <tr class="trHeight">
            <td class="tdLeft">CPU</td>
            <td class="tdRight">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option2"  autocomplete="off"><p class="inline pRed">&#128078;</p></input>
                    </label>
                </div>
            </td>
          </tr>
          <tr class="trHeight"class="trHeight">
            <td class="tdLeft">Graphics</td>
            <td class="tdRight">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option2"  autocomplete="off"><p class="inline pRed">&#128078;</p></input>
                    </label>
                </div>
            </td>
          </tr>
          <tr class="trHeight">
            <td class="tdLeft">Keyboard</td>
            <td class="tdRight">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option2"  autocomplete="off"><p class="inline pRed">&#128078;</p></input>
                    </label>
                </div>
            </td>
          </tr>
          <tr class="trHeight">
            <td class="tdLeft">Battery</td>
            <td class="tdRight">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option1" autocomplete="off"><p class="inline pGreen">&#128077;</p></input>
                    </label>
                    <label class="btn btn-default">
                        <input type="radio" name="options" id="option2"  autocomplete="off"><p class="inline pRed">&#128078;</p></input>
                    </label>
                </div>
            </td>
          </tr>
        </tbody>
    </table>

    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-8" align="left">
        <label>Rating:</label><br/>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4" align="right">
        <div class="rating">
            <span><input type="radio" name="rating" id="str6" value="6"><label for="str6"></label></span>
            <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
            <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
            <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
            <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
            <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" align="left" >
        <label>Comment:</label><br/>
    </div>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <textarea class="form-control" style="font-weight: bold" rows="5" id="comment" placeholder="Here is some text input"></textarea>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br/></div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <button type="submit" class="btn btn-default"><b>Submit</b></button>
        <button type="submit" class="btn btn-default"><b>Cancel</b></button><br/>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ><br/><br/><br/><br/></div>
</div>
@stop
