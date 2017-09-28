# Silverstripe HTML Blocks

Allows to inject HTML Blocks into .SS templates and HTMLContent as shortcode (TODO).

```html
<% if $HTMLBlockExist('social-links') %>
	{$HTMLBlock('social-links')} <%-- you can manage this HTML part from the admin panel now --%>
<% else %>
	<ul>
    	<li><a href="https://en-gb.facebook.com/openhouselondon2017" target="_blank" class="social">Facebook</a></li>
		<li><a href="https://twitter.com/openhouselondon" target="_blank" class="social">Twitter</a></li>
		<li><a href="https://www.instagram.com/openhouselondon/" target="_blank" class="social">Instagram</a></li>
	</ul>
<% end_if %>
```


![how to use HTML Blocks 1](https://raw.githubusercontent.com/qunabu/silverstripe-htmlblocks/master/images/howtouse1.png)

![how to use HTML Blocks 2](https://raw.githubusercontent.com/qunabu/silverstripe-htmlblocks/master/images/howtouse2.png)
