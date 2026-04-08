 {assign var="num_results" value=$listing_search.num_results}
 {assign var="current_page" value=$listing_search.current_page}
 {assign var="first_page" value=$listing_search.first_page}
 {assign var="last_page" value=$listing_search.last_page}
 {assign var="total_pages" value=$listing_search.total_pages}

  {if $total_pages > 1}
    <div class="sj-pagination">
      {if $current_page != 1}
        {assign var='previous_page' value=$current_page-1}
        <a href="?searchId={$searchId}&amp;action=search&amp;page={$previous_page}" class="sj-page-btn sj-arrow">&larr;</a>
      {/if}

      {section name=counter start=1 loop=$total_pages+1}
        {assign var="page" value=$smarty.section.counter.index}
        {if $page >= $first_page && $page <= $last_page}
          {if $page == $current_page}
            <span class="sj-page-btn active">{$page}</span>
          {else}
            <a href="?searchId={$searchId}&amp;action=search&amp;page={$page}" class="sj-page-btn">{$page}</a>
          {/if}
        {/if}
      {/section}

      {if $current_page < $total_pages}
        {assign var='next_page' value=$current_page+1}
        <a href="?searchId={$searchId}&amp;action=search&amp;page={$next_page}" class="sj-page-btn sj-arrow">&rarr;</a>
      {/if}
    </div>
  {/if}