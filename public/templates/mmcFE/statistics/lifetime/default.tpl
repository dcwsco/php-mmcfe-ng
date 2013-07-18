{include file="global/block_header.tpl" ALIGN="left" BLOCK_HEADER="Top Lifetime Shares"}
<center>
  <table width="100%" border="0" style="font-size:13px;">
    <thead>
      <tr style="background-color:#B6DAFF;">
        <th class="center">Rank</th>
        <th class="left" scope="col">User Name</th>
        <th class="right" scope="col">Valid</th>
        <th class="right" scope="col">Invalid</th>
      </tr>
    </thead>
    <tbody>
{assign var=rank value=1}
{assign var=listed value=0}
{section user $LIFETIMESHARES}
      <tr{if $GLOBAL.userdata.username == $LIFETIMESHARES[user].username}{assign var=listed value=1} style="background-color:#99EB99;"{else} class="{cycle values="odd,even"}"{/if}>
        <td class="center">{$rank++}</td>
        <td class="left">{$LIFETIMESHARES[user].username}</td>
        <td class="right">{$LIFETIMESHARES[user].valid}</td>
        <td class="right">{$LIFETIMESHARES[user].invalid}</td>
      </tr>
{/section}
{if $listed != 1}
      <tr style="background-color:#99EB99;">
        <td class="center">n/a</td>
        <td class="left">{$GLOBAL.userdata.username}</td>
        <td class="right">{$YOURLIFETIMESHARES.valid}</td>
        <td class="right">{$YOURLIFETIMESHARES.invalid}</td>
      </tr>
{/if}
    </tbody>
  </table>
</center>
  {include file="global/block_footer.tpl"}
