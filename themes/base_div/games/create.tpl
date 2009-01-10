<div class="container" style="width:{page:width}">
    <div class="headb">{lang:mod} - {lang:create}</div>
    <div class="leftb">{lang:body}</div>
</div>
<br />
<form method="post" name="games_create" action="{url:form}" enctype="multipart/form-data">
  <table class="forum" cellpadding="0" cellspacing="1" style="width:{page:width}">
    <tr>
      <td class="leftb">{icon:package_games} {lang:name} *</td>
      <td class="leftc"><input type="text" name="games_name" value="{games:name}" maxlength="200" size="50"  />
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:kate} {lang:version} *</td>
      <td class="leftc"><input type="text" name="games_version" value="{games:version}" maxlength="200" size="50"  />
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:folder_yellow} {lang:genre} *</td>
      <td class="leftc">{games:genre}
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:1day} {lang:release}</td>
      <td class="leftc">{games:release} 
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:kedit} {lang:creator}</td>
      <td class="leftc"><input type="text" name="games_creator" value="{games:creator}" maxlength="200" size="50"  />
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:gohome} {lang:homepage}</td>
      <td class="leftc"><input type="text" name="games_url" value="{games:homepage}" maxlength="200" size="50"  />
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:kedit} {lang:usk}</td>
      <td class="leftc">{games:usk}
      </td>
    </tr>
    <tr>
      <td class="leftb">{icon:images} {lang:iconedit}</td>
      <td class="leftc"><input type="file" name="symbol" value=""  />
        <br />
        <br />
        {games:clip}</td>
    </tr>
    <tr>
      <td class="leftb">{icon:ksysguard} {lang:options}</td>
      <td class="leftc"><input type="submit" name="submit" value="{lang:create}" />
        <input type="reset" name="reset" value="{lang:reset}" />
      </td>
    </tr>
  </table>
</form>
