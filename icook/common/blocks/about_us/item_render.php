

  <?php
    $link = $data->getObjectLink();
    $temp = strstr( $data->object_content, 'src="http:');
    $url = substr( $temp,  5, 46);
  ?>

  <div class="page">
      <h3 class="site-title"><?php echo $data->object_name;?></h3>
      <?php echo $data->object_content;?>
      <hr/>
      <div class="comments-area">
              <h3>3 people told me</h3>

              <ul class="commentlist">
                  <li>
                      <div class="comment">
                          <p>If this generates a title of a book or short story already in existence, I assure you, it was completely random. If it generates a title you’d like to use, go right ahead.</p>
                          <span class="comment-info">
                              <i>by</i> Admin <i>on</i> <span>december 21, 2014</span> <i>at</i> 12:45 - <a href="#">Reply</a>
                          </span>
                      </div>

                      <ul class="children">
                          <li>
                              <div class="comment">
                                  <p>Vel te tritani consequuntur. Pri oblique deterruisset ad, sed id recusabo elaboraret. Ex quo alii elit, vivendo referrentur pri ne. Ad eam integre ornatus volutpat, vel alia incorrupte liberavisse.</p>
                                  <span class="comment-info">
                              <i>by</i> Admin <i>on</i> <span>december 21, 2014</span> <i>at</i> 12:45 - <a href="#">Reply</a>
                          </span>
                              </div>
                          </li>
                      </ul>
                  </li>
                  <li>
                      <div class="comment">
                          <p>Lorem ipsum dolor sit amet, pro sanctus ullamcorper ei, sonet commodo ad sed. Ne exerci dolorum sit. Mea evertitur signiferumque et. Doctus probatus intellegat nec ne. Vim an bonorum efficiantur, in assum primis euismod duo, tritani labitur has ei.</p>
                          <span class="comment-info">
                              <i>by</i> Admin <i>on</i> <span>december 21, 2014</span> <i>at</i> 12:45 - <a href="#">Reply</a>
                          </span>
                      </div>
                  </li>
              </ul>

              <div id="respond" class="comment-respond">
                  <h3>Tell me something</h3>
                  <form action="#" method="post" id="commentform" class="comment-form">
                      <div class="row">
                          <div class="col-md-4">
                              <p>Name</p><input class="comments-line" name="author" type="text">
                          </div>
                          <div class="col-md-4">
                              <p>E-mail</p><input class="comments-line" name="email" type="text">
                          </div>
                          <div class="col-md-4">
                              <p>Website</p><input class="comments-line" name="url" type="text">
                          </div>
                      </div>
                      <p>Comment</p>
                      <textarea class="comments-area" name="comment"></textarea>
                      <p class="form-submit">
                          <input name="submit" type="submit" id="submit" value="post comment" class="comments-button">
                          <input type="hidden" name="comment_post_ID" value="" id="comment_post_ID">
                          <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                      </p>
                  </form>
              </div>
          </div>
  </div>
