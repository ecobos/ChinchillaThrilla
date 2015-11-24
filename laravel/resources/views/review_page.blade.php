@extends('master_page')

@section('specialized_css')
    {!! Html::style('css/review.css') !!}
@stop

@section('content')
    <div>
        <div id="label_padding" class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1>Product Review</h1>
            </div>
        </div>
        <div id="review_padding" class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="table table-responsive table-condensed">
                    <thead>
                      <tr>
                        <th>Feature</th>
                        <th>Vote</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="leftWidth">Screen</td>
                        <td class="rightWidth">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="leftWidth">CPU</td>
                        <td class="rightWidth">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="leftWidth">Graphics</td>
                        <td class="rightWidth">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="leftWidth">Keyboard</td>
                        <td class="rightWidth">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                        <td class="leftWidth">Battery</td>
                        <td class="rightWidth">
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                </label>
                            </div>
                        </td>
                      </tr>
                      <tr>
                          <td class="leftWidth">Keyboard</td>
                          <td class="rightWidth">
                              <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                  </label>
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                  </label>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td class="leftWidth">Battery</td>
                          <td class="rightWidth">
                              <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                  </label>
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                  </label>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td class="leftWidth">Keyboard</td>
                          <td class="rightWidth">
                              <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                  </label>
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                  </label>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td class="leftWidth">Battery</td>
                          <td class="rightWidth">
                              <div class="btn-group" data-toggle="buttons">
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option1" autocomplete="off"><p class="greenBtn">&#128077;</p></input>
                                  </label>
                                  <label class="btn btn-default">
                                      <input type="radio" name="options" id="option2"  autocomplete="off"><p class="redBtn">&#128078;</p></input>
                                  </label>
                              </div>
                          </td>
                      </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="review_padding" class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" align="left">
                <label>Rating:</label><br/>
            </div>
        </div>
        <div class="row">
                <div class="rating">
                    <span><input type="radio" name="rating" id="str6" value="6"><label for="str6"></label></span>
                    <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
                    <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                    <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                    <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                    <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                </div>
        </div>

        <div class="row">
            <div class="col-sm-3 col-md-3 col-lg-3" align="left" >
                <label>Comment:</label>
            </div>
            <div class="col-sm-9 col-md-9 col-lg-9"><br><br></div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <textarea class="form-control" style="font-weight: bold" rows="5" id="comment" placeholder="Here is some text input"></textarea>
            </div>
        </div>
        <div id="review_padding" class="row">
            <div class="col-sm-12 col-md-12 col-lg-12" >
                <button type="submit" class="btn btn-default"><b>Submit</b></button>
                <button type="submit" class="btn btn-default"><b>Cancel</b></button><br/>
            </div>
        </div>
    </div>
@stop
