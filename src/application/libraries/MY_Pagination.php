<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  MY_Pagination extends CI_Pagination{
	
	var $anchor ="";
	
	function create_links(){
		
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0){
			return '';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1){
			return '';
		}

		// Determine the current page number.
		$CI =&get_instance();
		
	    
		$search_condition =($CI->input->get()?'?'.http_build_query($CI->input->get()):'').$this->anchor;
		//这里改的很坑爹，我擦...这个类逻辑完全有问题。又怕影响到其他页面，所以只能给我自己做个判断
		$search_condition=(strpos($search_condition,'page=')!==false?'':$search_condition);

		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE){
			if ($CI->input->get($this->query_string_segment) != 0){
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}else{
			if ($CI->uri->segment($this->uri_segment) != 0){
				$this->cur_page = $CI->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1){
			show_error('Your number of links must be a positive number.');
		}

		if (!is_numeric($this->cur_page) || $this->cur_page<1){
			$this->cur_page = 1;
		}
		

		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->cur_page > $num_pages){
			$this->cur_page = $num_pages - 1;
		}

		//$uri_page_number = $this->cur_page;
		//$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		//$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		//$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;
		$start	= floor(($this->cur_page-1)/$this->num_links)*$this->num_links+1;
		$end	= ($start + $this->num_links-1) <  $num_pages?($start + $this->num_links-1):$num_pages;
		
		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE){
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}else{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}

		// And here we go...
		$output = '';

		// Render the "First" link
		//AND $this->cur_page > ($this->num_links + 1)
		if  ($this->first_link !== FALSE and $this->cur_page>1){
			$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
			$output .= $this->first_tag_open.'<a '.$this->anchor_class.'href="'.$first_url.$search_condition.'">'.$this->first_link.'</a>'.$this->first_tag_close;
		}

		// Render the "previous" link
		if  ($this->prev_link !== FALSE AND $this->cur_page != 1){
			//$i = $uri_page_number - $this->per_page;
			$i = $this->cur_page - 1;
			if ($i == 0 && $this->first_url != ''){
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.$search_condition.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}else{
				$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$i.$search_condition.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
		}

		// Render the pages
		if ($this->display_pages !== FALSE){
			// Write the digit links
			for ($loop = $start; $loop <= $end; $loop++){
				//$i = ($loop * $this->per_page) - $this->per_page;
				$i = $loop;

				if ($i > 0){
					if ($this->cur_page == $loop){
						$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
					}else{
						$n = ($i == 0) ? '' : $i;

						if ($n == '' && $this->first_url != ''){
							$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.$search_condition.'">'.$loop.'</a>'.$this->num_tag_close;
						}else{
							$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;
							$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$n.$search_condition.'">'.$loop.'</a>'.$this->num_tag_close;
						}
					}
				}
			}
		}

		// Render the "next" link
		if ($this->next_link !== FALSE AND $this->cur_page < $num_pages){
			$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.($this->cur_page+1).$this->suffix.$search_condition.'">'.$this->next_link.'</a>'.$this->next_tag_close;
		}
			
		// Render the "Last" link
		// AND ($this->cur_page + $this->num_links) < $num_pages
		if ($this->last_link !== FALSE and $this->cur_page < $num_pages){
			$i = $num_pages;
			$output .= $this->last_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.$search_condition.'">'.$this->last_link.'</a>'.$this->last_tag_close;
		}
		
		//显示页面
		/*$output.= '<span>　| 共 '.$this->total_rows.' 条 | 每页 '.$this->per_page.' 条 | 到第 <select style="text-align:center" onchange="if(this.value){window.location.href=\''.$this->base_url.$this->prefix.'\'+this.value+\''.$this->suffix.$search_condition.'\'}">';
		for($len=1;$len<=$num_pages;$len++){
			$output.='<option value="'.$len.'"';
			$output.=$len==$this->cur_page?' selected="selected"':'';
			$output.='>'.$len.'</option>';		 
		}
		$output.= '</select> / '.$num_pages.' 页&nbsp;</span>';*/
		
		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;
				
		return $output;
	}
}
