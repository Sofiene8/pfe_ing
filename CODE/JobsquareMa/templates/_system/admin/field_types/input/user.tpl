{if $user_group.name == 'Job Seeker'}
    <input type="text" value="{$value|escape}" name="{$id}" id="{$id}" placeholder="[[Enter full name or email]]"/>
{else}
    <input type="text" value="{$value|escape}" name="{$id}" id="{$id}" placeholder="[[Enter company name, contact name or email]]"/>
{/if}
<i class="fa fa-caret-down" aria-hidden="true"></i>
{javascript}
    <script>
        $(document).ready(function() {
            $('#{$id}').autocomplete({
                delay: 1,
                minLength: 0,
                source: function(request, response) {
                    var params = {
                        'username[user_like]': request.term,
                        action: 'search',
                        format: 'json',
                        page: 1,
                        itemsPerPage: 20,
                        minLength: 0
                    };
                    $.get(window.SJB_AdminSiteUrl + '/manage-users/{$user_group.id|lower}/', params, function(data) {
                        var users = [];
                        $.each(data, function() {
                            var user = {
                                label: (this.CompanyName ? this.CompanyName : this.FullName) + ' - ' + this.username,
                                value: this.username
                            };
                            users.push(user);
                        });
                        response(users);
                    });
                }
            }).focus(function () {
                $(this).autocomplete('search', '')
            });
        });
    </script>
{/javascript}