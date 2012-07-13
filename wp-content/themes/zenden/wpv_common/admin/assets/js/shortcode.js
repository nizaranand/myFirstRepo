var wpv_shortcode_last_update = 0;

(function($, undefined) {

var shortcode = {
	preview: function() {
		if(Date.parse(new Date()) - wpv_shortcode_last_update > 1000) {
			wpv_shortcode_last_update = Date.parse(new Date());
				
			$('#shortcode_preview_content').val(shortcode.generate()).parent().submit();
		}
	},
	
	init: function() {
		
		$('#shortcodes :checkbox').iButton();
		$('#shortcodes .wpv-range-input').uirange();
		$("#shortcodes input[type='color']").mColorPicker();
		
		$('.shortcode_send').click(function() {
			$.colorbox.close();
			shortcode.sendToEditor();
			return false;
		});
		
		$('.shortcode_content *').change(function(e) {
			shortcode.preview();
		}).change();
		
		$('a[href="#shortcode_preview"]').click(function() {
			shortcode.preview();
		});
		
		$('.shortcode_sub_selector select').val('');
		$('.shortcode_sub_selector select').change(function() {
			$('.sub_shortcode_wrap').hide();
			if($(this).val() !='')
				$("#sub_shortcode_" + $(this).val()).show();
		});
		
		$('[name="sc_tabs_number"]').change(function() {
			var tabs_number = $(this).val();
			$('#shortcode_tabs .wpv-config-row').each(function(i){
				if(i > tabs_number*2 +3)
					$(this).hide();
				else
					$(this).show();
			});
		}).change();
		
		$('[name="sc_accordion_number"]').change(function() {
			var acc_number = $(this).val();
			$('#shortcode_accordion .wpv-config-row').each(function(i){
				if(i > acc_number*2 + 1)
					$(this).hide();
				else
					$(this).show();
			});
		}).change();
		
		$('[name="sc_slider_number"]').change(function() {
			var slides_number = parseInt($(this).val(), 10);
			$('#shortcode_slider .wpv-config-row').each(function(i){
				if(i > slides_number + 10)
					$(this).hide();
				else
					$(this).show();
			});
		}).change();
		
		$('[name="sc_showcase_slides"], [name="sc_showcase_columns"], [name="sc_showcase_annotation"]').change(function() {
			var slides_number = parseInt($('[name="sc_showcase_slides"]').val(), 10) * 
									(
										$('[name="sc_showcase_annotation"]').val().length>0 ?
											parseInt($('[name="sc_showcase_columns"]').val(), 10)-1 :
											parseInt($('[name="sc_showcase_columns"]').val(), 10)
									);
									
			$('#shortcode_showcase .wpv-config-row').show();
			$('#shortcode_showcase .wpv-config-row:nth-child(n+'+(slides_number+12)+')').hide();
		}).change();
		
		$('.slide-type').change(function() {
			$(this).closest('.wpv-config-row').attr('data-slide-type', $(this).val());
		});

		if(window.tinyMCE && tinyMCE.activeEditor) {
			var selection = tinyMCE.activeEditor.selection.getContent();
			if($('body').attr('data-wpvshortcode') == 'table') {
				shortcode.table_element = $(tinyMCE.activeEditor.selection.getNode()).parents('table.mceItemTable:first');
				if(shortcode.table_element.length > 0) {
					shortcode.table_element.wrap('<div />');
					selection = shortcode.table_element.parent().html();
					shortcode.table_element.unwrap();
				}
			}

			var fill_with_selection = [
				'styled_boxes_framed_box_content',
				'styled_boxes_messageboxes_content',
				'styled_boxes_note_box_content',
				'tooltip_content',
				'typography_dropcap1_text',
				'typography_dropcap2_text',
				'typography_dropcap3_text',
				'typography_dropcap4_text',
				'typography_blockquote_content',
				'typography_styledlist_content',
				'typography_icon_text',
				'typography_highlight_content',
				'toggle_content',
				'table_content',
				'text_divider_text'
			];
				
			for(i in fill_with_selection) {
				$('#sc_'+fill_with_selection[i]).val(selection).change();
			}
		}
	},
	
	generate: function() {
		var type = $('body').attr('data-wpvshortcode');
		switch(type) {
			
		case 'column':
			var type = shortcode.getVal('column', 'type');
			if(type != '')
				return '\n['+type+']'+shortcode.getVal('column', 'content')+'[/'+type+']';
				
			return '';
		break;
		
		case 'columns':
			var sub_type = shortcode.getVal('columns','selector');
			switch(sub_type) {
			
			case 'one_half_layout':
				return '\n[one_half]'+shortcode.getVal('columns', 'one_half_layout', '1')+'[/one_half]' +
					   '\n[one_half_last]'+shortcode.getVal('columns', 'one_half_layout', '2')+'[/one_half_last]';
				
			case 'one_third_layout':
				return '\n[one_third]'+shortcode.getVal('columns', 'one_third_layout', '1')+'[/one_third]' +
					   '\n[one_third]'+shortcode.getVal('columns', 'one_third_layout', '2')+'[/one_third]' +
					   '\n[one_third_last]'+shortcode.getVal('columns', 'one_third_layout', '3')+'[/one_third_last]';
					   
			case 'one_fourth_layout':
				return '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_layout', '1')+'[/one_fourth]' +
					   '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_layout', '2')+'[/one_fourth]' +
					   '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_layout', '3')+'[/one_fourth]' +
					   '\n[one_fourth_last]'+shortcode.getVal('columns', 'one_fourth_layout', '4')+'[/one_fourth_last]';

			case 'one_fifth_layout':
				return '\n[one_fifth]'+shortcode.getVal('columns', 'one_fifth_layout', '1')+'[/one_fifth]' +
					   '\n[one_fifth]'+shortcode.getVal('columns', 'one_fifth_layout', '2')+'[/one_fifth]' +
					   '\n[one_fifth]'+shortcode.getVal('columns', 'one_fifth_layout', '3')+'[/one_fifth]' +
					   '\n[one_fifth]'+shortcode.getVal('columns', 'one_fifth_layout', '4')+'[/one_fifth]' +
					   '\n[one_fifth_last]'+shortcode.getVal('columns', 'one_fifth_layout', '5')+'[/one_fifth_last]';

			case 'one_sixth_layout':
				return '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_layout', '1')+'[/one_sixth]' +
					   '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_layout', '2')+'[/one_sixth]' +
					   '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_layout', '3')+'[/one_sixth]' +
					   '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_layout', '4')+'[/one_sixth]' +
					   '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_layout', '5')+'[/one_sixth]' +
					   '\n[one_sixth_last]'+shortcode.getVal('columns', 'one_sixth_layout', '6')+'[/one_sixth_last]';

			case 'one_third_two_thirds':
				return '\n[one_third]'+shortcode.getVal('columns', 'one_third_two_thirds', '1')+'[/one_third]' +
					   '\n[two_thirds_last]'+shortcode.getVal('columns', 'one_third_two_thirds', '2')+'[/two_thirds_last]';

			case 'two_thirds_one_third':
				return '\n[two_thirds]'+shortcode.getVal('columns', 'two_thirds_one_third', '1')+'[/two_thirds]' +
					   '\n[one_third_last]'+shortcode.getVal('columns', 'two_thirds_one_third', '2')+'[/one_third_last]';

			case 'one_fourth_three_fourths':
				return '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_three_fourths', '1')+'[/one_fourth]' +
					   '\n[three_fourths_last]'+shortcode.getVal('columns', 'one_fourth_three_fourths', '2')+'[/three_fourths_last]';

			case 'three_fourths_one_fourth':
				return '\n[three_fourths]'+shortcode.getVal('columns', 'three_fourths_one_fourth', '1')+'[/three_fourths]' +
					   '\n[one_fourth_last]'+shortcode.getVal('columns', 'three_fourths_one_fourth', '2')+'[/one_fourth_last]';

			case 'one_fourth_one_fourth_one_half':
				return '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_one_fourth_one_half', '1')+'[/one_fourth]' +
					   '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_one_fourth_one_half', '2')+'[/one_fourth]' +
					   '\n[one_half_last]'+shortcode.getVal('columns', 'one_fourth_one_fourth_one_half', '3')+'[/one_half_last]';

			case 'one_fourth_one_half_one_fourth':
				return '\n[one_fourth]'+shortcode.getVal('columns', 'one_fourth_one_half_one_fourth', '1')+'[/one_fourth]' +
					   '\n[one_half]'+shortcode.getVal('columns', 'one_fourth_one_half_one_fourth', '2')+'[/one_half]' +
					   '\n[one_fourth_last]'+shortcode.getVal('columns', 'one_fourth_one_half_one_fourth', '3')+'[/one_fourth_last]';

			case 'one_half_one_fourth_one_fourth':
				return '\n[one_half]'+shortcode.getVal('columns', 'one_half_one_fourth_one_fourth', '1')+'[/one_half]' +
					   '\n[one_fourth]'+shortcode.getVal('columns', 'one_half_one_fourth_one_fourth', '2')+'[/one_fourth]' +
					   '\n[one_fourth_last]'+shortcode.getVal('columns', 'one_half_one_fourth_one_fourth', '3')+'[/one_fourth_last]';

			case 'four_fifths_one_fifth':
				return '\n[four_fifths]'+shortcode.getVal('columns', 'four_fifths_one_fifth', '1')+'[/four_fifths]' +
					   '\n[one_fifth_last]'+shortcode.getVal('columns', 'four_fifths_one_fifth', '2')+'[/one_fifth_last]';

			case 'one_fifth_four_fifths':
				return '\n[one_fifth]'+shortcode.getVal('columns', 'one_fifth_four_fifths', '1')+'[/one_fifth]' +
					   '\n[four_fifths_last]'+shortcode.getVal('columns', 'one_fifth_four_fifths', '2')+'[/four_fifths_last]';

			case 'two_fifths_three_fifths':
				return '\n[two_fifths]'+shortcode.getVal('columns', 'two_fifths_three_fifths', '1')+'[/two_fifths]' +
					   '\n[three_fifths_last]'+shortcode.getVal('columns', 'two_fifths_three_fifths', '2')+'[/three_fifths_last]';

			case 'three_fifths_two_fifths':
				return '\n[three_fifths]'+shortcode.getVal('columns', 'three_fifths_two_fifths', '1')+'[/three_fifths]' +
					   '\n[two_fifths_last]'+shortcode.getVal('columns', 'three_fifths_two_fifths', '2')+'[/two_fifths_last]';

			case 'one_sixth_five_sixths':
				return '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_five_sixths', '1')+'[/one_sixth]' +
					   '\n[five_sixths_last]'+shortcode.getVal('columns', 'one_sixth_five_sixths', '2')+'[/five_sixths_last]';

			case 'five_sixths_one_sixth':
				return '\n[five_sixths]'+shortcode.getVal('columns', 'five_sixths_one_sixth', '1')+'[/five_sixths]' +
					   '\n[one_sixth_last]'+shortcode.getVal('columns', 'five_sixths_one_sixth', '2')+'[/one_sixth_last]';

			case 'one_sixth_one_sixth_one_sixth_one_half':
				return '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_one_sixth_one_sixth_one_half', '1')+'[/one_sixth]' +
					   '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_one_sixth_one_sixth_one_half', '2')+'[/one_sixth]' +
					   '\n[one_sixth]'+shortcode.getVal('columns', 'one_sixth_one_sixth_one_sixth_one_half', '3')+'[/one_sixth]' +
					   '\n[one_half_last]'+shortcode.getVal('columns', 'one_sixth_one_sixth_one_sixth_one_half', '4')+'[/one_half_last]';
			}
		break;
		
		case 'typography':
			var sub_type = shortcode.getVal('typography','selector');
			switch(sub_type){
			case 'push':
				var height = shortcode.getVal('typography', 'push', 'h');
				height = ' h="'+height+'"';
				
				return '[push'+height+']';
			case 'dropcap1':
			case 'dropcap2':
			case 'dropcap3':
			case 'dropcap4':
				var color = shortcode.getVal('typography',sub_type,'color');
				color = ' color="'+color+'"';
				
				return '['+sub_type+color+']'+shortcode.getVal('typography',sub_type,'text')+'[/'+sub_type+']';
				break;
			case 'blockquote':
				var align = shortcode.getVal('typography','blockquote','align');
				var cite = shortcode.getVal('typography','blockquote','cite');
				
				align = ' align="'+align+'"';
				cite = ' cite="'+cite+'"';

				return '[blockquote'+align+cite+']'+ shortcode.getVal('typography','blockquote','content') +'[/blockquote]';
				break;
			case 'pre_code':
				var s = shortcode.getVal('typography','pre_code','type');
				s = this.def(s=='', 'code', s);
				
				return '['+s+']'+shortcode.getVal('typography','pre_code','content')+'[/'+s+']';
			case 'styledlist':
				var style = shortcode.getVal('typography','styledlist','style');
				var color = shortcode.getVal('typography','styledlist','color');
				
				style = ' style="'+style+'"';
				color = ' color="'+color+'"';
				
				return '[list'+style+color+']'+shortcode.getVal('typography','styledlist','content')+'[/list]';
			case 'icon':
				var style = shortcode.getVal('typography','icon','style');
				var color = shortcode.getVal('typography','icon','color');
				var size = shortcode.getVal('typography','icon','size');
				
				style = ' style="'+style+'"';
				color = ' color="'+color+'"';
				size = ' size="'+size+'"';
				
				return '[icon'+style+color+size+'] '+shortcode.getVal('typography','icon','text')+'[/icon]';
			case 'highlight':
				var t = shortcode.getVal('typography','highlight','type');
				t = ' type="'+t+'"';
				
				return '[highlight'+t+']'+shortcode.getVal('typography','highlight','content')+'[/highlight]';
			}
		break;
		
		case 'styled_boxes':
			var sub_type = shortcode.getVal('styled_boxes','selector');
			switch(sub_type){
			case 'messageboxes':
				var t = shortcode.getVal('styled_boxes','messageboxes','type');
				if(t == '')
					t='info';
				
				return '['+t+']'+shortcode.getVal('styled_boxes','messageboxes','content')+'[/'+t+']';
			case 'framed_box':
				var width = shortcode.getVal('styled_boxes','framed_box','width');
				var height = shortcode.getVal('styled_boxes','framed_box','height');
				var bgColor = shortcode.getVal('styled_boxes','framed_box','bgColor');
				var textColor = shortcode.getVal('styled_boxes','framed_box','textColor');
				var rounded = shortcode.getVal('styled_boxes','framed_box','rounded');

				width = ' width="'+width+'"';
				height = ' height="'+height+'"';
				bgColor = ' bgColor="'+bgColor+'"';
				textColor = ' textColor="'+textColor+'"';
				rounded = ' rounded="'+!!rounded+'"';
				
				return '[framed_box'+width+height+bgColor+textColor+rounded+']'+shortcode.getVal('styled_boxes','framed_box','content')+'[/framed_box]';
			case 'note_box':
				var title = shortcode.getVal('styled_boxes','note_box','title');
				var align = shortcode.getVal('styled_boxes','note_box','align');
				var width = shortcode.getVal('styled_boxes','note_box','width');

				title = ' title="'+title+'"';
				align = ' align="'+align+'"';
				width = ' width="'+width+'"';
				
				return '[note'+title+align+width+']'+shortcode.getVal('styled_boxes','note_box','content')+'[/note]';
			}
		break;
		
		case 'table':
			return '[styled_table]'+shortcode.getVal('table','content')+'[/styled_table]';
		break;
		
		case 'buttons':
			var id = shortcode.getVal('buttons','id');
			var c = shortcode.getVal('buttons','class');
			var size = shortcode.getVal('buttons','size');
			var align = shortcode.getVal('buttons','align');
			var link = shortcode.getVal('buttons','link');
			var linkTarget = shortcode.getVal('buttons','linkTarget');
			var color = shortcode.getVal('buttons','color');
			var text = shortcode.getVal('buttons','text');
			var bgColor = shortcode.getVal('buttons','bgColor');

			id = ' id="'+id+'"';
			c = ' class="'+c+'"';
			size = ' size="'+size+'"';
			align = ' align="'+align+'"';
			link = ' link="'+link+'"';
			linkTarget = ' linkTarget="'+linkTarget+'"';
			color = ' color="'+color+'"';
			bgColor = ' bgColor="'+bgColor+'"';
			
			return '[button'+id+c+size+align+link+linkTarget+color+bgColor+']'+text+'[/button]';
		break;
		
		case 'tabs':
			var number = shortcode.getVal('tabs', 'number');
			var style = shortcode.getVal('tabs', 'style');
			var delay = shortcode.getVal('tabs', 'delay');
			var vertical = shortcode.getVal('tabs', 'vertical');
			
			style = ' style="'+style+'"';
			delay = ' delay="'+delay+'"';
			vertical = ' vertical="'+!!vertical+'"';
			
			var ret = '[tabs'+style+delay+vertical+']';
			for(var i=1; i<=number; i++)
				ret +='\n[tab title="'+shortcode.getVal('tabs','title_'+i)+'"]'+shortcode.getVal('tabs','content_'+i)+'[/tab]\n';
			
			ret +='[/tabs]';
			return ret;
		break;
		
		case 'accordion':
			var number = shortcode.getVal('accordion','number');
			var mini = shortcode.getVal('accordion','mini');
			var ret = '[accordions mini="'+mini+'"]';
			
			for(var i=1; i<=number; i++)
				ret += '\n[accordion title="'+
							shortcode.getVal('accordion','title_'+i)+'"]'+
							shortcode.getVal('accordion','content_'+i)+
						'[/accordion]\n';
			
			ret += '[/accordions]';
			return ret;
		break;
		
		case 'toggle':
			return  '[toggle title="'+shortcode.getVal('toggle','title')+'" hidden="'+shortcode.getVal('toggle','hidden')+'"]' +
						shortcode.getVal('toggle','content') +
					'[/toggle]';
		break;
		
		case 'divider':
			var type = shortcode.getVal('divider','type');
			
			switch(type) {
				case 'underline-5':
					return '[underline t="-5"]';
				case 'underline-10':
					return '[underline t="-10"]';
				case 'underline_dark-5':
					return '[underline_dark t="-5"]';
				case 'underline_dark-10':
					return '[underline_dark t="-10"]';
				default:
					return '['+type+']';
			}
		break;
		
		case 'images':
			var src = shortcode.getVal('images','src');
			var title = shortcode.getVal('images','title');
			var size = shortcode.getVal('images','size');
			var align = shortcode.getVal('images','align');
			var lightbox = shortcode.getVal('images','lightbox');
			var group = shortcode.getVal('images','group');
			var width = shortcode.getVal('images','width');
			var height = shortcode.getVal('images','height');
			var autoHeight = shortcode.getVal('images','autoHeight');
			var link = shortcode.getVal('images','link');
			var quality = shortcode.getVal('images','quality');
			var frame = shortcode.getVal('images','frame');
			var underline = shortcode.getVal('images','underline');
			var link_class = shortcode.getVal('images','link_class');

			size = ' size="'+size+'"';
			align = ' align="'+align+'"';
			lightbox = ' lightbox="'+!!lightbox+'"';
			link = ' link="'+link+'"';
			link_class = ' link_class="'+link_class+'"';
			group = ' group="'+group+'"';
			width = ' width="'+width+'"';
			height = ' height="'+height+'"';
			autoHeight = ' autoHeight="'+!!autoHeight+'"';
			title = ' title="'+title+'"';
			quality = ' quality="'+quality+'"';
			frame = ' frame="'+!!frame+'"';
			underline = ' underline="'+!!underline+'"';
			
			return '[image'+title+size+align+lightbox+group+link+width+height+autoHeight+quality+frame+link_class+underline+']'+src+'[/image]';
		break;
		
		case 'iframe':
			var src = shortcode.getVal('iframe','src');
			var width = shortcode.getVal('iframe','width');
			var height = shortcode.getVal('iframe','height');
			
			src = ' src="'+src+'"';
			width = ' width="'+width+'"';
			height = ' height="'+height+'"';
			
			return '[iframe'+src+width+height+']';
		break;
		
		case 'gmap':
			var width = shortcode.getVal('gmap','width');
			var height = shortcode.getVal('gmap','height');
			var address = shortcode.getVal('gmap','address');
			var latitude = shortcode.getVal('gmap','latitude');
			var longitude = shortcode.getVal('gmap','longitude');
			var zoom = shortcode.getVal('gmap','zoom');
			var marker = shortcode.getVal('gmap','marker');
			var html = shortcode.getVal('gmap','html');
			var popup = shortcode.getVal('gmap','popup');
			var controls = shortcode.getVal('gmap','controls');
			var scrollwheel = shortcode.getVal('gmap','scrollwheel');
			var maptype = shortcode.getVal('gmap','maptype');

			width = ' width="'+width+'"';
			height = ' height="'+height+'"';
			address = ' address="'+address+'"';
			latitude = ' latitude="'+latitude+'"';
			longitude = ' longitude="'+longitude+'"';
			zoom = ' zoom="'+zoom+'"';
			marker = ' marker="'+!!marker+'"';
			popup = ' popup="'+popup+'"';
			html = ' html="'+html+'"';
			controls = ' controls="'+controls+'"';
			scrollwheel = ' scrollwheel="'+!!scrollwheel+'"';
			
			maptype = ' maptype="'+maptype+'"';

			return '[gmap'+width+height+address+latitude+longitude+zoom+marker+popup+html+controls+scrollwheel+maptype+']';
		break;
		
		case 'widget':
			var sub_type = shortcode.getVal('widget','selector');
			switch(sub_type) {
			case 'contactform':
				var email = shortcode.getVal('widget','contactform','email');
				email = ' email="'+email+'"';
				
				var content = shortcode.getVal('widget','contactform','content');
				if(content != "")
					return '[contactform'+email+']'+content+'[/contactform]';
				return '[contactform'+email+']';
			break;
			case 'twitter':
				var username = shortcode.getVal('widget','twitter','username');
				var count = shortcode.getVal('widget','twitter','count');
				var avatarSize = shortcode.getVal('widget','twitter','avatarSize');
				var query = shortcode.getVal('widget','twitter','query');
				
				username = ' username="'+username+'"';
				count = ' count="'+count+'"';
				
				avatarSize = ' avatarSize="'+avatarSize+'"';
				
				query = ' query="'+query+'"';
				
				return '[twitter'+username+count+avatarSize+query+']';
			break;
			case 'flickr':
				var id = shortcode.getVal('widget','flickr','id');
				var type = shortcode.getVal('widget','flickr','type');
				var count = shortcode.getVal('widget','flickr','count');
				var display = shortcode.getVal('widget','flickr','display');
				
				id = ' id="'+id+'"';
				type = ' type="'+type+'"';
				count = ' count="'+count+'"';
				display = ' display="'+display+'"';
				
				return '[flickr'+id+type+count+display+']';
			break;
			case 'contact_info':
				var color = shortcode.getVal('widget','contact_info','color');
				var phone = shortcode.getVal('widget','contact_info','phone');
				var cellphone = shortcode.getVal('widget','contact_info','cellphone');
				var email = shortcode.getVal('widget','contact_info','email');
				var address = shortcode.getVal('widget','contact_info','address');
				var city = shortcode.getVal('widget','contact_info','city');
				var state = shortcode.getVal('widget','contact_info','state');
				var zip = shortcode.getVal('widget','contact_info','zip');
				var name = shortcode.getVal('widget','contact_info','name');

				color = ' color="'+color+'"';
				phone = ' phone="'+phone+'"';
				cellphone = ' cellphone="'+cellphone+'"';
				email = ' email="'+email+'"';
				address = ' address="'+address+'"';
				city = ' city="'+city+'"';
				state = ' state="'+state+'"';
				zip = ' zip="'+zip+'"';
				name = ' name="'+name+'"';
				
				return '[contact_info'+color+phone+cellphone+email+address+city+state+zip+name+']';
			break;
			}
		break;
		
		case 'video':
			var sub_type = shortcode.getVal('video','selector');
			switch(sub_type){
				case 'html5':
					var poster = shortcode.getVal('video','html5','poster');
					var mp4 = shortcode.getVal('video','html5','mp4');
					var webm = shortcode.getVal('video','html5','webm');
					var ogg = shortcode.getVal('video','html5','ogg');
					var width = shortcode.getVal('video','html5','width');
					var height = shortcode.getVal('video','html5','height');
					var preload = shortcode.getVal('video','html5','preload');
					var autoplay = shortcode.getVal('video','html5','autoplay');

					poster = ' poster="'+poster+'"';
					mp4 = ' mp4="'+mp4+'"';
					webm = ' webm="'+webm+'"';
					ogg = ' ogg="'+ogg+'"';
					width = ' width="'+width+'"';
					height = ' height="'+height+'"';
					autoplay = ' autoplay="'+!!autoplay+'"';
					preload = ' preload="'+!!preload+'"';
					
					return '[video type="html5"'+poster+mp4+webm+ogg+width+height+preload+autoplay+']';
				break;
				
				case 'flash':
					var src = shortcode.getVal('video','flash','src');
					var width = shortcode.getVal('video','flash','width');
					var height = shortcode.getVal('video','flash','height');
					var play = shortcode.getVal('video','flash','play');
					var flashvars = shortcode.getVal('video','flash','flashvars');

					src = ' src="'+src+'"';
					width = ' width="'+width+'"';
					height = ' height="'+height+'"';
					play = ' play="'+!!play+'"';
					flashvars = ' flashvars="'+flashvars+'"';
					
					return '[video type="flash"'+src+width+height+play+flashvars+']';
				break;
				
				case 'youtube':
					var src = shortcode.getVal('video','youtube','src');
					var width = shortcode.getVal('video','youtube','width');
					var height = shortcode.getVal('video','youtube','height');

					src = ' src="'+src+'"';
					width = ' width="'+width+'"';
					height = ' height="'+height+'"';
					
					return '[video type="youtube"'+src+width+height+']';
				break;
				
				case 'vimeo':
					var src = shortcode.getVal('video','vimeo','src');
					var width = shortcode.getVal('video','vimeo','width');
					var height = shortcode.getVal('video','vimeo','height');
					var title = shortcode.getVal('video','vimeo','title');
					
					src = ' src="'+src+'"';
					width = ' width="'+width+'"';
					height = ' height="'+height+'"';
					title = ' title="'+!!title+'"';

					return '[video type="vimeo"'+src+width+height+title+']';
				break;
				
				case 'dailymotion':
					var src = shortcode.getVal('video','dailymotion','src');
					var width = shortcode.getVal('video','dailymotion','width');
					var height = shortcode.getVal('video','dailymotion','height');

					src = ' src="'+src+'"';
					width = ' width="'+width+'"';
					height = ' height="'+height+'"';
					
					return '[video type="dailymotion"'+src+width+height+']';
					break;
			};
		break;
		
		case 'lightbox':
			var href = shortcode.getVal('lightbox','href');
			var title = shortcode.getVal('lightbox','title');
			var group = shortcode.getVal('lightbox','group');
			var width = shortcode.getVal('lightbox','width');
			var height = shortcode.getVal('lightbox','height');
			var c = shortcode.getVal('lightbox','class');
			var iframe = shortcode.getVal('lightbox','iframe');
			var inline = shortcode.getVal('lightbox','inline');
			var inline_id = shortcode.getVal('lightbox','inline_id');
			var inline_html = shortcode.getVal('lightbox','inline_html');
			var photo = shortcode.getVal('lightbox','photo');
			var close = shortcode.getVal('lightbox','close');
			
			href = ' href="'+href+'"';
			title = ' title="'+title+'"';
			group = ' group="'+group+'"';
			width = ' width="'+width+'"';
			height = ' height="'+height+'"';
			c = ' class="'+c+'"';
			iframe = ' iframe="'+!!iframe+'"';
			
			if(inline===true) {
				inline = ' inline="true"';
				inline_html = '<div class="hidden"><div id="'+inline_id+'">'+inline_html+'</div></div>';
				href = ' href="#'+inline_id+'"';
			} else {
				inline = '';
				inline_html = '';
			}
			
			photo = ' photo="'+!!photo+'"';
			close = ' close="'+!!close+'"';
			
			return '[lightbox'+title+group+href+width+height+c+iframe+inline+photo+close+']'+shortcode.getVal('lightbox','content')+'[/lightbox]'+inline_html;
		break;
		
		case 'tooltip':
			var tooltip_content = shortcode.getVal('tooltip', 'tooltip_content');
			
			tooltip_content = ' tooltip_content="'+tooltip_content+'"';
			
			
			return '[tooltip'+tooltip_content+']'+shortcode.getVal('tooltip', 'content')+'[/tooltip]';
		break;
		
		case 'chart':
			var data = shortcode.getVal('chart','data');
			var labels = shortcode.getVal('chart','labels');
			var colors = shortcode.getVal('chart','colors');
			var bg = shortcode.getVal('chart','bg');
			var size = shortcode.getVal('chart','size');
			var title = shortcode.getVal('chart','title');
			var type = shortcode.getVal('chart','type');
			var advanced = shortcode.getVal('chart','advanced');

			data = ' data="'+data+'"';
			labels = ' labels="'+labels+'"';
			colors = ' colors="'+colors+'"';
			bg = ' bg="'+bg+'"';
			size = ' size="'+size+'"';
			title = ' title="'+title+'"';
			type = ' type="'+type+'"';
			advanced = ' advanced="'+advanced+'"';

			return '[chart'+data+labels+bg+size+title+type+advanced+']';
		break;
		
		case 'portfolio':
			var column = shortcode.getVal('portfolio','column');
			var width = shortcode.getVal('portfolio','width');
			var nopaging = shortcode.getVal('portfolio','nopaging');
			var max = shortcode.getVal('portfolio','max');
			var sortable = shortcode.getVal('portfolio','sortable');
			var cat = shortcode.getVal('portfolio','cat');
			var ids = shortcode.getVal('portfolio','ids');
			var title = shortcode.getVal('portfolio','title');
			var desc = shortcode.getVal('portfolio','desc');
			var more = shortcode.getVal('portfolio','more');
			var moreText = shortcode.getVal('portfolio','moreText');
			var group = shortcode.getVal('portfolio','group');
			var height = shortcode.getVal('portfolio','height');
			var is_long = shortcode.getVal('portfolio','long');

			if(nopaging===true) {
				nopaging = ' nopaging="true"';
				max = '';
			} else {
				nopaging = ' nopaging="false"';
			}
			
			if(sortable===true) {
				sortable = ' sortable="true"';
				nopaging = ' nopaging="true"';
				max = '';
			} else {
				sortable = ' sortable="false"';
			}
			
			cat = (cat !== null && cat !== undefined) ? cat : '';
			ids = (ids !== null && ids !== undefined) ? ids : '';
			
			column = ' column="'+column+'"';
			width = ' width="'+width+'"';
			cat = ' cat="'+cat+'"';
			max = ' max="'+max+'"';
			ids = ' ids="'+ids+'"';
			title = ' title="'+!!title+'"';
			desc = ' desc="'+!!desc+'"';
			more = ' more="'+!!more+'"';
			moreText = ' moreText="'+moreText+'"';
			group = ' group="'+!!group+'"';
			is_long = ' is_long="'+!!is_long+'"';
			height = ' height="'+height+'"';

			return '[portfolio'+column+nopaging+sortable+max+cat+ids+title+desc+more+moreText+group+height+is_long+width+']';
		break;
		
		case 'blog':
			var count = shortcode.getVal('blog','count');
			var posts = shortcode.getVal('blog','posts');
			var cat = shortcode.getVal('blog','cat');
			var image = shortcode.getVal('blog','image');
			var img_style = shortcode.getVal('blog','img_style');
			var meta = shortcode.getVal('blog','meta');
			var full = shortcode.getVal('blog','full');
			var nopaging = shortcode.getVal('blog','nopaging');
			var width = shortcode.getVal('blog','width');
			var news = shortcode.getVal('blog','news');
			var split = shortcode.getVal('blog','split');

			posts = (posts != null) ? posts : '';
			cat = (cat != null) ? cat : '';

			count = ' count="'+count+'"';
			width = ' width="'+width+'"';
			split = ' split="'+split+'"';
			cat = ' cat="'+cat+'"';
			posts = ' posts="'+posts+'"';
			image = ' image="'+!!image+'"';
			img_style = ' img_style="'+img_style+'"';
			meta = ' meta="'+!!meta+'"';
			full = ' full="'+!!full+'"';
			nopaging = ' nopaging="'+!!nopaging+'"';
			news = ' news="'+!!news+'"';
			
			return '[blog'+count+posts+cat+image+img_style+meta+full+nopaging+width+split+news+']';
		break;
		
		case 'sitemap':
			var sub_type = shortcode.getVal('sitemap','selector');
			switch(sub_type) {
				case 'all':
					var shows = shortcode.getVal('sitemap','all','shows');
					var number = shortcode.getVal('sitemap','all','number');

					shows = ' shows="'+shows+'"';
					number = ' number="'+number+'"';
					
					return '[sitemap type="all"'+shows+number+']';
				break;
				
				case 'pages':
					var depth = shortcode.getVal('sitemap','pages','depth');
					var number = shortcode.getVal('sitemap','pages','number');

					depth = ' depth="'+depth+'"';
					number = ' number="'+number+'"';

					return '[sitemap type="pages"'+depth+number+']';
				break;
				
				case 'categories':
					var show_count = shortcode.getVal('sitemap','categories','show_count');
					var show_feed = shortcode.getVal('sitemap','categories','show_feed');
					var depth = shortcode.getVal('sitemap','categories','depth');
					var number = shortcode.getVal('sitemap','categories','number');
					
					show_count = ' show_count="'+!!show_count+'"';
					show_feed = ' show_feed="'+!!show_feed+'"';
					depth = ' depth="'+depth+'"';
					number = ' number="'+number+'"';
					
					return '[sitemap type="categories"'+show_count+show_feed+depth+number+']';
				break;
				
				case 'posts':
					var show_comment = shortcode.getVal('sitemap','posts','show_comment');
					var number = shortcode.getVal('sitemap','posts','number');
					var posts = shortcode.getVal('sitemap','posts','posts');
					var cat = shortcode.getVal('sitemap','posts','cat');
					
					show_comment = ' show_comment="'+!!show_comment+'"';
					cat = ' cat="'+cat+'"';
					number = ' number="'+number+'"';
					posts = ' posts="'+posts+'"';
					
					return '[sitemap type="posts"'+show_comment+number+posts+cat+']';
				break;
				
				case 'portfolios':
					var show_comment = shortcode.getVal('sitemap','portfolios','show_comment');
					var number = shortcode.getVal('sitemap','portfolios','number');
					var cat = shortcode.getVal('sitemap','portfolios','cat');
					
					show_comment = ' show_comment="'+!!show_comment+'"';
					cat = ' cat="'+cat+'"';
					number = ' number="'+number+'"';
					
					return '[sitemap type="portfolios"'+show_comment+number+cat+']';
				break;
			}
			break;
			
			case 'slogan':
				var text = shortcode.getVal('slogan', 'text');
				var button_text = shortcode.getVal('slogan', 'button_text');
				var link = shortcode.getVal('slogan', 'link');
				var nopadding = shortcode.getVal('slogan', 'nopadding');
				var carved = shortcode.getVal('slogan', 'carved');
				var background = shortcode.getVal('slogan', 'background');
				var text_color = shortcode.getVal('slogan', 'text_color');
				var font = shortcode.getVal('slogan', 'font');
	
				button_text = ' button_text="'+button_text+'"';
				link = ' link="'+link+'"';
				nopadding = ' nopadding="'+!!nopadding+'"';
				carved = ' carved="'+!!carved+'"';
				font = ' font="'+font+'"';
				background = ' background="'+background+'"';
				text_color = ' text_color="'+text_color+'"';
				
				return '[slogan'+button_text+link+nopadding+carved+background+text_color+']'+text+'[/slogan]';
			break;

			case 'text_divider':
				var text = shortcode.getVal('text_divider', 'text');
				
				return '[text_divider]'+text+'[/text_divider]';
			break;
			
			case 'team_member':
				var name = shortcode.getVal('team_member', 'name');
				var position = shortcode.getVal('team_member', 'position');
				var phone = shortcode.getVal('team_member', 'phone');
				var email = shortcode.getVal('team_member', 'email');
				var picture = shortcode.getVal('team_member', 'picture');
				var description = shortcode.getVal('team_member', 'description');
	
				name = ' name="'+name+'"';
				position = ' position="'+position+'"';
				phone = ' phone="'+phone+'"';
				email = ' email="'+email+'"';
				picture = ' picture="'+picture+'"';
				
				return '[team_member'+name+position+phone+email+picture+']'+description+'[/team_member]';
			break;
			
			case 'price':
				var ids = ['text_align',
							'price',
							'price_size',
							'price_background',
							'price_color',
							'title',
							'title_size',
							'title_background',
							'title_color',
							'description',
							'description_color',
							'description_background',
							'button_text',
							'button_link',
							'currency',
							'duration',
							'summary'
							];
							
				var vals = {}, data = '';
				
				for(i in ids) {
					vals[ids[i]] = shortcode.getVal('price', ids[i]);
					
					if(ids[i] != 'description') {
						vals[ids[i]] = ' '+ids[i]+'="'+vals[ids[i]]+'"';
						data += vals[ids[i]];
					}
				}
				
				return '[price'+data+']'+vals['description']+'[/price]';
			break;
			
			case 'services':
				var ids = [ 
							'icon',
							'text_align',
							'title',
							'title_size',
							'description',
							'description_size',
							'button_text',
							'button_link',
							'no_button',
							'fullimage',
							'class',
							'image_height'
							];
							
				var vals = {}, data = '';
				
				for(i in ids) {
					vals[ids[i]] = shortcode.getVal('services', ids[i]);
					
					if(ids[i] != 'description') {
						vals[ids[i]] = ' '+ids[i]+'="'+vals[ids[i]]+'"';
						data += vals[ids[i]];
					}
				}
				
				return '[services'+data+']'+vals['description']+'[/services]';
			break;
			
			case 'slider':
				var number = shortcode.getVal('slider', 'number');
				var ret = '[slider ';

				fields = [
					'width',
					'height',
					'caption_opacity',
					'effect',
					'animspeed',
					'pausetime',
					'pauseonhover',
					'style',
					'annotation',
					'highlight'
				];
						
				for(i in fields) {
					ret += fields[i] + '="';
					ret += shortcode.getVal('slider', fields[i]);
					ret += '" ';
				}
						
				ret += ']';
					
				for(var i=1; i<=number; i++) {
					ret += '\n[slide img="'+
								shortcode.getVal('slider', i+'_image')+'"] '+
								shortcode.getVal('slider', i+'_html')+
							'[/slide]\n';
				}
				
				ret += '[/slider]';
						
				return ret;
			break;
			
			case 'showcase':
				var columns = shortcode.getVal('showcase', 'columns');
				var slides = shortcode.getVal('showcase', 'slides');
				var ret = '[showcase ';

				fields = [
					'width',
					'height',
					'effect',
					'animspeed',
					'pausetime',
					'pauseonhover',
					'columns',
					'annotation'
				];
						
				for(i in fields) {
					ret += fields[i] + '="';
					ret += shortcode.getVal('showcase', fields[i]);
					ret += '" ';
				}
						
				ret += ']';
				
				var images = slides * (shortcode.getVal('showcase', 'annotation').length>0 ? (columns-1) : columns);
					
				for(var i=1; i<=images; i++) {
					ret += '\n[image]'+shortcode.getVal('showcase', i+'_image')+'[/image]\n';
				}
				
				ret += '[/showcase]';
						
				return ret;
			break;
		}
		return '';
	},
	
	def: function(condition, on_true, on_false) {
		if(condition)
			return on_true;
		return on_false || '';
	},
	
	getVal: function(a,b,c) {
		if(b === undefined) {
			var target = $('[name="sc_'+a+'"]');
			if(target.is('.toggle-button'))
				return target.is(':checked');
				
			if(target.size() == 0)
				return $('[name="sc_'+a+'[]"]').val();
			return target.val();
		} else if(c === undefined) {
			var target = $('[name="sc_'+a+'_'+b+'"]');
			if(target.is('.toggle-button'))
				return target.is(':checked');
			
			if(target.size() == 0)
				return $('[name="sc_'+a+'_'+b+'[]"]').val();
			return target.val();
		} else {
			var target = $('[name="sc_'+a+'_'+b+'_'+c+'"]');
			if(target.is('.toggle-button'))
				return target.is(':checked');
			
			if(target.size() == 0)
				return $('[name="sc_'+a+'_'+b+'_'+c+'[]"]').val();
			return target.val();
		}
		
	},
	
	sendToEditor: function() {
		if($('body').attr('data-wpvshortcode') == 'table' && shortcode.table_element.length > 0) {
			shortcode.table_element.replaceWith(shortcode.generate());
		} else {
			send_to_editor("\n" + shortcode.generate() + "\n");
		}
	}
		
}

$(function() {
	shortcode.init();
});

$(window).bind('wpv_shortcodes_loaded', function() {
	shortcode.init();
});

})(jQuery);
