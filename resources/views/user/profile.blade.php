@include('user.header')

<!-- App Capsule -->
<div id="appCapsule" class="appCap">
    <div class="container mb-2 mt-2">
        <!-- Profile Section -->
        <div class="section mt-3 text-center">
            <div class="avatar-section">
                <a href="#" data-bs-toggle="modal" data-bs-target="#photo">
                    <img src="{{ asset(Auth::user()->passport_path ? Auth::user()->passport_path : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random') }}"
                        alt="avatar" class="imaged w100 rounded">
                </a>

            </div>
        </div>

        <!-- Profile Details -->
        <ul class="listview image-listview text inset">
            <li>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#profile">
                    <div class="in">
                        <div>{{ Auth::user()->name }}</div>
                        <span class="text-primary">
                            <i class="fas fa-edit"></i> EDIT PROFILE
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Checkings Balance</div>
                        <span class="text-primary">
                            {{ number_format($checking_balance, 2) }}
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Savings Balance</div>
                        <span class="text-primary">
                            {{ number_format($savings_balance, 2) }}
                        </span>
                    </div>
                </a>
            </li>
        </ul>

        <!-- Contact Details -->
        <div class="listview-title mt-1">&nbsp;</div>
        <ul class="listview image-listview text inset">
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Email</div>
                        <span class="text-primary">
                            {{ Auth::user()->email }}
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Country</div>
                        <span class="text-primary">
                            {{ Auth::user()->country ?? '-1' }}
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>City</div>
                        <span class="text-primary">
                            {{ Auth::user()->city ?? 'Texas' }}
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <div>Gender</div>
                        <span class="text-primary">
                            {{ Auth::user()->gender ?? 'Male' }}
                        </span>
                    </div>
                </a>
            </li>
            <li>
                <a href="#" class="item">
                    <div class="in">
                        <span class="text-primary">
                            {{ Auth::user()->address ?? 'Houston texas' }}
                        </span>
                    </div>
                </a>
            </li>
        </ul>

        <!-- Security Section -->
        <div class="listview-title mt-1">Security</div>
        <ul class="listview image-listview text inset" id="Password">
            <li>
                <a href="#" class="item" data-bs-toggle="modal" data-bs-target="#pass">
                    <div class="in">
                        <div class="text-danger">Change Password</div>
                        <span class="text-primary">
                            <i class="fas fa-user-shield"></i>
                        </span>
                    </div>
                </a>
            </li>
        </ul>
    </div>
</div>

<!-- Modals -->
<!-- Change Profile Photo Modal -->
<div class="modal fade dialogbox" id="photo" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.upload-photo') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Change Profile Photo</h5>
                </div>
                <div class="modal-body text-start mb-2">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <input type="file" class="form-control" name="photo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-text-primary">UPLOAD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade dialogbox" id="profile" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Profile</h5>
                </div>
                <div class="modal-body text-start mb-2">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="name">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                required>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="country">Country</label>
                            <select name="country" class="form-control" id="country" required>
                                <option value="{{ Auth::user()->country }}">{{ Auth::user()->country ?? '-1' }}</option>
                                <!-- Add more country options here -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="city">City</label>
                            <select name="city" class="form-control" id="city">
                                <option value="{{ Auth::user()->city }}">{{ Auth::user()->city ?? 'Texas' }}</option>
                                <!-- Add more city options here -->
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="gender">Gender</label>
                            <select class="form-control" name="gender" required>
                                <option value="">-Select-</option>
                                <option value="Male" {{ Auth::user()->gender === 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ Auth::user()->gender === 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other" {{ Auth::user()->gender === 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="address">Address</label>
                            <textarea class="form-control" rows="3"
                                name="address">{{ Auth::user()->address ?? 'Houston texas' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-text-primary">UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade dialogbox" id="pass" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.change-password') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                </div>
                <div class="modal-body text-start mb-2">
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="old_password">Old Password</label>
                            <input type="password" class="form-control" name="old_password" required>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="new_password">New Password</label>
                            <input type="password" class="form-control" name="new_password" minlength="5" required>
                        </div>
                    </div>
                    <div class="form-group basic">
                        <div class="input-wrapper">
                            <label class="label" for="confirm_password">Confirm New Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-text-primary">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('user.footer')