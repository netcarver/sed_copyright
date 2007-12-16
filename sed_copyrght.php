<?php

$plugin['revision'] = '$LastChangedRevision$';

$revision = @$plugin['revision'];
if( !empty( $revision ) )
	{
	$parts = explode( ' ' , trim( $revision , '$' ) );
	$revision = $parts[1];
	if( !empty( $revision ) )
		$revision = '.' . $revision;
	}

$plugin['name'] = 'sed_copyright';
$plugin['version'] = '1.3' . $revision;
$plugin['author'] = 'Netcarver';
$plugin['author_uri'] = 'http://txp-plugins.netcarving.com';
$plugin['description'] = 'Automatic generation of the copyright notice.';
$plugin['type'] = 1;

@include_once('../zem_tpl.php');

if (0) {
?>
<!-- CSS
# --- BEGIN PLUGIN CSS ---
<style type="text/css">
div#sed_help td { vertical-align:top; }
div#sed_help code { font-weight:bold; font: 105%/130% "Courier New", courier, monospace; background-color: #FFFFCC;}
div#sed_help code.sed_code_tag { font-weight:normal; border:1px dotted #999; background-color: #f0e68c; display:block; margin:10px 10px 20px; padding:10px; }
div#sed_help a:link, div#sed_help a:visited { color: blue; text-decoration: none; border-bottom: 1px solid blue; padding-bottom:1px;}
div#sed_help a:hover, div#sed_help a:active { color: blue; text-decoration: none; border-bottom: 2px solid blue; padding-bottom:1px;}
div#sed_help h1 { color: #369; font: 20px Georgia, sans-serif; margin: 0; text-align: center; }
div#sed_help h2 { border-bottom: 1px solid black; padding:10px 0 0; color: #369; font: 17px Georgia, sans-serif; }
div#sed_help h3 { color: #693; font: bold 12px Arial, sans-serif; letter-spacing: 1px; margin: 10px 0 0;text-transform: uppercase;}
</style>
# --- END PLUGIN CSS ---
-->
<!-- HELP
# --- BEGIN PLUGIN HELP ---
<div id="sed_help">

h1(#manual). Display Copyright Notice Plugin

sed_copyright plugin, v1.3

Outputs a copyright message in one of the following formats...

<code class='sed_code_tag'>Copyright-Section [Date-Section] Owner-Section</code>

or

<code class='sed_code_tag'>Copyright-Section Owner-Section [Date-Section]</code>

Where the optional _date-section_ can be a single date (either the start or the end date) or a date range in the format "_start-date_ - _end-date_". The dates can be provided as an attribute to the plugin or the plugin can work them out based on the oldest article posted to the DB and the latest update to any article on the site. If comments count as 'modifications' to the site then the DB of articles is checked, otherwise the last_mod value in the global preferences is used.

The copyright-section and owner-section are customizable via the tag attributes and the owner section can now hyper-link to other resources.

Wraptag and class for the resulting notice are also customizable.

h2(#changes). Changes from last version

* Fixed duplicate key warnings.
* Updated for 4.0.4
* Fixed site url for plugins page.
* Updates to allow operation with latest version of sed_plugin_library (v0.3)
* Added missing help information.

h2(#sed-copyright-date-tag). The <code><txp:sed_copyright_date/></code> tag.

This tag can take the following attributes&#8230;

|_. Attribute  |_. Default Value |_. Description |
| 'start_year' |=. ''            | Optional: Sets the start year. Omit or leave empty for automatic detection of start year. |
| 'end_year'   |=. ''            | Optional: Sets the end year. Omit or leave empty for auto detect of end year. Set to 'now' to use the current year. |
| 'date_type'  |=. 'range'       | Optional: sets the type of date stamp. Valid: 'none', 'range', 'start' or 'end'. |

h3. Examples&#8230;

Here are some examples of how to use this tag...

h3. Basic use.

<code class="sed_code_tag"><notextile><txp:sed_copyright_date/></notextile></code>

...will give you the start_year--end_year range from your DB, unless the articles have all been written in the same year in which case you will only get that year.

h3. Only display the current year.

<code class="sed_code_tag"><notextile><txp:sed_copyright_date date_type='end' end_year='now'/></code>

In 2008 this would display "2008" and in 2009 the year would update too--regardless of when the articles in the site were actually posted.

h3. Fixed start year, automatic end year.

<code class="sed_code_tag"><notextile><txp:sed_copyright_date start_year='2000'/></notextile></code>

This would give 2000--200x where 200x is the year of the last mod to the articles.

h2(#sed-copyright-tag). The <code><txp:sed_copyright/></code> tag.

This tag can take the following attributes&#8230;

|_. Attribute    |_. Default Value |_. Description |
| 'owner'      |=. ''            | Optional copyright owner. Omit or leave empty to default to the site name, but you should supply this if the copyright owner is different from the TXP site name. |
| 'owner_href'  |=. ''         | *The href to use for the owner-section. Omit or leave blank for none.*<br/>If you want an email link then prepend with 'mailto:' |
| 'owner_title' |=. ''         | *The title for the owner-section href.* |
| 'copy_text'  |=. '&copy;'      | The copyright string to use before the date-section. |
| 'start_year' |=. ''            | Optional: Sets the start year. Omit or leave empty for automatic detection of start year. |
| 'end_year'   |=. ''            | Optional: Sets the end year. Omit or leave empty for auto detect of end year. Set to 'now' to use the current year. |
| 'date_type'  |=. 'range'       | Optional: sets the type of date stamp. Valid: 'none', 'range', 'start' or 'end'. |
| 'order'      |=. 'cdo'         | Optional: order of sections. Omit or leave blank for default copyright-date-owner order.<br/>
Valid values: 'cdo', 'cod' |
| 'wraptag'    |=. ''           | Optional: Name of the tag to use to wrap the listing.<br/>*Now defaults to blank (=no wrap tag)* |
| 'class'      |=. 'copyright'   | Optional: Name of class to use for the wrap tag. |
| *'custom'*   |=. *''*          | Optional: When used in an article or article form, this specifies the name of the custom field to search for per-article values. |

*These items* have changed since the last release.

h3. Examples&#8230;

Here are some examples of how to use this tag...

h3. Basic use.

<code class="sed_code_tag"><notextile><txp:sed_copyright owner='John Doe' /></notextile></code>

Will produce the message "&copy; [date-section] John Doe" where the content of the [date-section] depends on the articles in your site. If the oldest post was in 2003 and the most recent mod in 2006 then you would get "&copy; 2003-2006 John Doe" but if the first post was in 2006 as well you would only get "&copy; 2006 John Doe".

If you omit the owner attribute then the site name will be used instead. This is Okay for sites where the site name matches the copyright owner. On other sites you should provide this attribute.

h3. Change the output year(s).

Year manipulation is as for the <code><notextile><txp:sed_copyright_date/></notextile></code> tag.

h3. Change the copyright message.

<code class="sed_code_tag"><notextile><txp:sed_copyright owner='John Doe' copy_text='Copyright'/></notextile></code>

h3. Change the order of the sections in the notice.

<code class="sed_code_tag"><notextile><txp:sed_copyright owner='John Doe' order='cod'/></notextile></code>

Produces the following: "&copy; John Doe 2006". If you omit the order attribute--or set it to any value other than 'cod'--then the sections will be output in cdo (copyright-date-owner) order.

h3. Changing the default wrap values.

<code class="sed_code_tag"><notextile><txp:sed_copyright owner='John Doe' wraptag='div' class='foobar'/></notextile></code>

*Note:* Now defaults to blank--that is, no wraptag. If you need the previous behaviour you will need to add @wraptag='p'@ to your attributes.

h3. Setting up the owner section as links.

<code class="sed_code_tag"><notextile><txp:sed_copyright owner='John Doe' owner_href='http://txp-plugins.netcarving.com/plugins/johns-article/' owner_title="Click here to go to John's page."/></notextile></code>

The above example will output the following: "&copy; 2005-2006 <a href="http://txp-plugins.netcarving.com/plugins/johns-article/" title="Click here to go to John's page.">John Doe</a>".  Note that the owner section is now a hyper-link to another page.

*NOTE:* If the href starts with *'mailto:'* then the tag will encode the email address in an attempt to prevent email harvesting.

h2(#per-article). Per-Article Copyright.

Include the @<txp:sed_copyright/>@ tag in an *article* or an *article form* and use the new 'custom' attribute to tell the tag which custom field to look in for custom values for the 'start', 'end', 'owner', 'owner_href' and 'owner_title' fields. If these values are missing then the tag defaults to the article author and the year of the article's posting. If the article is being published by you but the copyright belongs to a third party you can attribute it by using the custom field.

Steps for setting this up...

# Under *Admin > Preferences > Advanced preferences* name one of your empty custom fields. Remember this name!
# In a new or existing article, look for the custom field you just set up. It should be under "Advanced Options".
# In this field type "copyright(start='1066';end='2006';owner='King Harold')" but without the quotation marks.
# Add this tag to the body of the article @<txp:sed_copyright custom='my_name'/>@ Now publish your article and make sure it is live.
# Visit the page and you should see "&copy; 1066-2006 King Harold".

You can also include the owner_href and owner_title parameters in the custom field to setup a clickable link.

If you omit the owner field then it default's to the article author. If you omit the start year it defaults to the year the article was posted.

The main use of this approach would be for attributing article copyright to an individual not in the publishing chain or to the person who originally posted the article.

h2(#version-history). Version History

v1.3 October 23rd, 2006

* Fixed duplicate key warnings.
* Updated for 4.0.4
* Fixed site url for plugins page.
* Updates to allow operation with latest version of sed_plugin_library (v0.3)
* Added missing help information.

v1.2

* You can now use it in an article to show a per-article copyright message.
* Per-article copyright messages are fully customisable from one of the article's custom fields.
* Requires the sed_library_plugin to operate.


v1.1 May 20th, 2006

* Fixed a problem with the help section's css spilling over into the rest of the admin interface.<br> Symptoms being blue underlined hyperlinks on all the admin tabs. (Thanks Lee!)
* Updated the SQL queries to skip over non-live articles and future-posted articles. (Thanks Mary!)

v1.0 May 10th, 2006

* Cleaned up internal code a little. (Thanks raggar!)
* Changed the default wraptag to blank.
* Fixed a compatability problem with ied_plugin_composer.
* Fixed a display problem when installed from the plugin cache directory.

v0.3 May 7th, 2006

* Split out the date extraction part of the original tag and made it available as a new tag.<br/>Now you can pull the dates to make up your own copyright (or other) message as needed.
* You can now make the owner section into a link.
* If the owner_href starts with 'mailto:' then the rest of the reference will be encoded to try to stop email address harvesters.

v0.2 May 2nd, 2006

* Improved the cache handling code for the start and end years from the DB.
* Added a default value for the owner attribute: if left blank it will use the site name.
* Added some extra date checking code.
* Added a new attribute named 'order' which gives some flexibility in the ordering of the sections making up the notice.

v0.1 April 28th, 2006.

* Provide a way of detecting the first article in the DB and extract the _start_ year from this.
* Provide a way of detecting the latest update to the DB and extract the _end_ year from this.
* Provide a way of setting the copyright owner string.
* Provide a way of overriding the start/end dates.
* Provide a way of only using the start or end date.

h2(#credits). Credits.

This plugin was inspired by Nathan Smith's article about using php to set the copyright dates on his website "SonSpring":http://sonspring.com/journal/copyright-tip.

</div>
# --- END PLUGIN HELP ---
-->
<?php
}

# --- BEGIN PLUGIN CODE ---

// ------------------ IMMEDIATE CODE FOLLOWS ------------------

//
//	We need the field unpacking functions from the library...
//
require_plugin('sed_plugin_library');

if (@txpinterface == 'admin') {
	register_callback( '_sed_article_copyright_callback', 'article' );
	register_callback( '_sed_article_delete_callback', 'list' );
	}

define( 'SED_FIRST_POST_QUERY', 'Status>=4 order by `Posted` asc limit 0, 1' );
define( 'SED_LAST_MOD_QUERY', 'Status>=4 and `Posted` < now() order by `LastMod` desc limit 0, 1' );

// ------------------ PRIVATE FUNCTIONS FOLLOW ------------------

function _sed_article_delete_callback( $event, $step )	{
	//
	//	When an article is deleted from the DB we need to recalc the
	// first post year and last update year, just in case that article
	// was setting one or both of those dates...
	//
	if(!empty($step) and ('list_multi_edit' == $step)) {
		require_privs('article');

		$method = ps('method');
		$things = ps('selected');
		if( ($things) and ($method == 'delete') )
			_update_cache();
		}
	}

function _sed_article_copyright_callback( $event, $step ) {
	if( !empty($event) and ($event != 'article') )
		return;

	require_privs('article');

	$save = gps('save');
	if ($save)
		$step = 'save';

	$publish = gps('publish');
	if ($publish)
		$step = 'publish';

	switch(strtolower($step)) {
		case 'publish':
		case 'delete':
		case 'save':    _update_cache();
		}
	}

function _update_cache() {
	$first_post = safe_field( 'Posted', 'textpattern', SED_FIRST_POST_QUERY );
	$first_post = substr( $first_post, 0, 4 );
	@safe_upsert( 'txp_prefs', "val='$first_post', prefs_id='1'", "name='sed_first_post_year'" );

	$last_mod   = safe_field( 'lastmod', 'textpattern', SED_LAST_MOD_QUERY );
	$last_mod   = substr( $last_mod , 0, 4 );
	@safe_upsert( 'txp_prefs', "val='$last_mod', prefs_id='1'", "name='sed_last_mod_year'" );
	}

function _get_start_year( $start_year, &$extra ) {
	global $prefs;
	$result = '';

	if( !empty( $start_year ) ) {
		$result = $start_year;
		$extra = '(from Tag Atts)';
		}
	else {
		//	Have we done the lookup before?
		//
		if( array_key_exists('sed_first_post_year', $prefs) ) {
			//
			//	Yes, so use the result...
			//
			$result = $prefs['sed_first_post_year'];
			$extra = '(start from cache)';
			}
		else {
			//	No, so find the youngest article...
			//
			$first_post = safe_field( 'Posted', 'textpattern', SED_FIRST_POST_QUERY );
			if( !empty( $first_post) )	{
				//
				//	Trim the date down to get the year...
				//
				$result = substr( $first_post, 0, 4 );
				$extra = '(start from Article Table)';

				//
				//	Now store the result (we need to create the extra field to do this.)
				//
				@safe_upsert( 'txp_prefs', "val='$result', prefs_id='1'", "name='sed_first_post_year'" );
				}
			}
		}

	// sanity check the resulting date...
	if( !empty( $result )) {
		$this_year = date('Y');
		if( $result > $this_year )
			$result = $this_year;
		}

	return $result;
	}

function _get_end_year( $end_year, &$extra ) {
	global $prefs;
	$result = '';

	if( !empty( $end_year ) ) {
		( 'now' === $end_year ) ? $result = date('Y') : $result = $end_year;
		$extra = '(from Tag Attr)';
		}
	else {
		if( array_key_exists('sed_last_mod_year', $prefs) && !empty($prefs['sed_last_mod_year'])  ) {
			$result = $prefs['sed_last_mod_year'];
			$extra = '(end from cache)';
			}
		else {
			if( $prefs['comment_means_site_updated'] )	{
				//
				//	Cannot rely of the $prefs['lastmod'] as even others' comments are updating that so pull from the DB instead...
				//
				$last_mod   = safe_field( 'lastmod', 'textpattern', SED_LAST_MOD_QUERY );
				if( !empty( $last_mod) )	{
					//
					//	Trim the date down to get the year...
					//
					$result = substr( $last_mod, 0, 4 );
					$extra = '(end from Article Table)';

					//
					//	Now store the result (we need to create the extra field to do this.)
					//
					$rs = @safe_upsert( 'txp_prefs', "val='$result', prefs_id='1'", "name='sed_last_mod_year'" );
					}
				}
			else {
				//	lastmod is tracking articles so pull it from the lastmod field of the $prefs...
				//
				$result = substr( $prefs['lastmod'] , 0 , 4 );
				$extra = '(end from Global Prefs)';
				}
			}
		}

	// sanity check the resulting date...
	if( !empty( $result )) {
		$this_year = date('Y');
		if( $result > $this_year )
			$result = $this_year;
		}

	return $result;
	}


//
//	Builds an 'a' hyperlink using the $text, $href strings and (optional)$title string.
//
//	The $href parameter needs to include the resource ID at the beginning...
//	Emails:				mailto:
//  Off-site links: 	http://
//
//	Unless they are on-site links.
//
function _sed_build_href( $text, $href, $title ) {
	$result = '';

	$href = strtolower( $href );
	if( strstr( $href, 'mailto:' ) )	{
		$href = eE( $href );
		$text = eE( $text );
		$title = eE( $title );
		}

	if( empty( $title ) )
		$result = "<a href=\"$href\">$text</a>";
	else
		$result = "<a href=\"$href\" title=\"$title\">$text</a>";

	return $result;
	}


// -------------- CLIENT-SIDE TAG HANDLERS FOLLOW --------------


//============= SED_COPYRIGHT_YEARS TAG HANDLER ================
//
//	Outputs a blank string, a year or a year range according to
// the $atts input. By default will output a year range where the
// start year is the year of the first posted article in the TXP
// article database table and the end year is either...
// 1. The year from the lasmod date from the global variables
// or
// 2. The year that the last change to the article DB table was
// committed
//
//	Of these, option 1 is faster but is not available to us if
// the TXP installation has comments updating the lastmod date.
//
function sed_copyright_date( $atts )	{
	global $thisarticle;
	global $prefs;
	global $is_article_list;
	global $sed_copyright_owner;

	$result = '';
	$sed_copyright_owner = '';

	extract( lAtts( array(
		'debug'		=> '',
		'custom'	=> '',
		'start_year'=> '', 		// Optional: Sets the start year. Leave empty for automatic detection of start year.
		'end_year' 	=> '',		// Optional: Sets the end year. Leave empty to autodetect end year. Set to 'now' for this year.
		'date_type' => 'range',	// Optional: sets the type of date stamp. Valid: 'range'(start-end), 'start' or 'end'.

		# The following are only needed to keep TxP 4.0.4+ happy in testing and debug modes!
		'owner'		=> $prefs['sitename'],	// Optional: Copyright owner. Goes after the date section.
		'owner_href'=> '',			// Optional: href for the owner string.
		'owner_title'=> '',			// Optional but recommended if href is set.Title attribute for the href.
		'copy_text'	=> '&copy;',	// Optional: The copyright string to use before the date section.
		'order'		=> 'cdo',		// Optional: order of sections. Omit or leave blank for default copyright-date-owner order.
									//		 Valid values: '', 'cdo', 'cod'.
		'wraptag'	=> '',			// Optional: Name of the tag to use to wrap the listing.
		'class'		=> 'copyright',	// Optional: Name of class to use for the wrap tag.
		'custom'	=> '',			// Optional: If you are using the tag in an article form or an article body,
									//			 set this to the custom field from which to read values.
		), $atts ));

	$start_extra = '';	//	Holds extra debug strings from date access routines.
	$end_extra = '';	//	Holds extra debug strings from date access routines.

	if( !empty($debug) ) {
		echo "<br/>=== Copyright Date: Start Attributes ===<br/>\n";
		print_r( $atts );
		echo "<br/>=== Copyright Date:  End  Attributes ===<br/>\n";
		print_r( "First post query:[".SED_FIRST_POST_QUERY."], Last mod query:[".SED_LAST_MOD_QUERY."]" );
		echo "<br/>=== Copyright Date:  End  Attributes ===<br/>\n";
		}

	//
	//	Call the date access routines. These will access the cached date variables if needed and also give extra information
	// for debug in the $_extra strings.
	//
	if( empty($custom) or (true==$is_article_list) ) {
		$start = _get_start_year( $start_year , $start_extra );
		$end   = _get_end_year( $end_year , $end_extra );
		}
	else{
		//	This section deals with article copyright processing. It looks in the named custom field for a section called 'copyright' and pulls
		// any needed details from it. Defaults to the posted date and article author but that can be overidden.
		//	copyright(attrib1='val1';attrib2='val2')
		//	Valid attributes are...
		//		owner 	(if not supplied defaults to the article author.)
		//		owner_href and owner_title.
		//		start	(if missing defaults to the year the article was posted)
		//		end		(if missing defaults to the start year)
		//
		$packed_string = @$thisarticle[$custom];
		$vars = sed_lib_extract_packed_variable_section( 'copyright' , $packed_string );

		$title = gAtt( $vars, 'owner_title' );
		$href  = gAtt( $vars, 'owner_href' );
		$sed_copyright_owner = gAtt( $vars , 'owner' , get_author_name($thisarticle['authorid']) );
		if( $sed_copyright_owner and isset($href) and isset($title) )
			$sed_copyright_owner = _sed_build_href( $sed_copyright_owner, $href, $title );

		$start = gAtt( $vars, 'start', date('Y', $thisarticle['posted']) );
		$end   = gAtt( $vars, 'start', $start );
		$start_extra = '(start from custom field)';
		$end_extra = '(end from custom field)';
		}

	//
	//	Only ouput the extra debug info if needed.
	//
	if( empty( $debug ) ) {
		$start_extra = '';
		$end_extra   = '';
		}

	//
	//	If a range has been requested and the start year is the same as the end year then compress the format...
	//
	if( ($date_type=='range') and ($start === $end) and ($start_extra === $end_extra ) )
		$date_type = 'end';

	//
	//	Do any other compressions as needed...
	//
	if( empty( $start ) && empty( $end ) )
		$date_type = 'none';
	if( empty( $start ) && !empty( $end ) )
		$date_type = 'end';
	if( !empty( $start ) && empty( $end ) )
		$date_type = 'start';

	//
	//	Format the resulting date string...
	//
	switch( $date_type )	{
		case 'range'	:	$result = $start_extra.$start.'-'.$end_extra.$end ;
							break;
		case 'start'	:	$result = $start_extra.$start;
							break;
		case 'end'		:	$result = $end_extra.$end;
							break;
		case 'none'		:	$result = '';
		}

	return $result;
	}


//============= SED_COPYRIGHT TAG HANDLER ================
//
//	Outputs a well formatted copyright message. It calls
// sed_copyright_year to pull out the information for the
// date-section then jois it with the copyright and owner
// sections to give you your formatted copyright message.
//
function sed_copyright($atts) {
	global $sed_copyright_owner;
	global $prefs;

	// define output variable(s)...
	$out_result = '';
	$debug = '';
	$sed_copyright_owner = '';

	// process attribute variables...
	extract( lAtts( array(
		'debug'		=> '',
		'custom'	=> '',
		'owner'		=> $prefs['sitename'],	// Optional: Copyright owner. Goes after the date section.
		'owner_href'=> '',			// Optional: href for the owner string.
		'owner_title'=> '',			// Optional but recommended if href is set.Title attribute for the href.
		'copy_text'	=> '&copy;',	// Optional: The copyright string to use before the date section.
		'start_year'=> '', 			// Optional: Sets the start year. Leave empty for automatic detection of start year.
		'end_year' 	=> '',			// Optional: Sets the end year. Leave empty for auto detect of end year or set to 'now' for current year.
		'date_type' => 'range',		// Optional: sets the type of date stamp. Valid: 'range'(start-end), 'start' or 'end'.
		'order'		=> 'cdo',		// Optional: order of sections. Omit or leave blank for default copyright-date-owner order.
									//			 Valid values: '', 'cdo', 'cod'.
		'wraptag'	=> '',			// Optional: Name of the tag to use to wrap the listing.
		'class'		=> 'copyright',	// Optional: Name of class to use for the wrap tag.
		'custom'	=> '',			// Optional: If you are using the tag in an article form or an article body, set this to the custom field from
									// 			 which to read values.
		), $atts));

	if( !empty( $debug ) ) {
		print_r( '<br/><br/><br/>' );
		print_r( $prefs );
		}

	//
	//	If being used with a custom field but outside and article, don't show anything!
	//
	if( !empty($custom) and !empty($thisarticle) and empty($thisarticle[$custom]))
		return '';

	// ----------- DATE SECTION PROCESSING ---------------
	//
	//	Simply call the date tag handler...
	//
	$date = sed_copyright_date( $atts );


	// ----------- OWNER SECTION PROCESSING ---------------
	//
	//	Build the owner link (if required)...
	//
	if( !empty($sed_copyright_owner) )
		$owner = $sed_copyright_owner;
	elseif( !empty( $owner_href ) )	{
		$owner = _sed_build_href( $owner, $owner_href, $owner_title );
		}

	// ---------------- MERGE SECTIONS -------------------
	//
	//	Join it together...
	//
	$bits = array();
	switch( $order )	{
		case 'cod':		$bits[] = $copy_text;
						$bits[] = $owner;
						if( !empty($date) ) $bits[] = $date;
						break;
		default:
						$bits[] = $copy_text;
						if( !empty($date) ) $bits[] = $date;
						$bits[] = $owner;
						break;
		}
	$out_result = implode(' ', $bits);

	if( !empty($wraptag) )
		$out_result = doTag( $out_result, $wraptag, $class );

	return $out_result;
    }

# --- END PLUGIN CODE ---

?>
